<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use App\Models\BlogAudio;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $hasTitleCaseModelLabel = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('title')
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (
                            Get $get,
                            Set $set,
                            ?string $old,
                            ?string $state
                        ) {
                            if (($get('slug') ?? '') !== Str::slug($old)) {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        })
                        ->required()
                    ->columnSpan(2),

                    TextInput::make('slug')
                        ->required(),

                    RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->image()
                        ->imageEditor()
                        ->required()
                        ->columnSpanFull(),

                    Repeater::make('images')
                        ->relationship('images')
                        ->label('Images')
                        ->schema([
                            FileUpload::make('image_path')
                                ->label('Image')
                                ->image()
                                ->imageEditor()
                                ->required(),
                        ])
                        ->columns(1)
                        ->reorderable()
                        ->orderColumn('sort_order')
                        ->addActionLabel('Add another image')
                        ->columnSpanFull(),

                    Repeater::make('audios')
                        ->relationship('audios')
                        ->label('Audio Files')
                        ->schema([
                            Select::make('language')
                                ->options(BlogAudio::languageOptions())
                                ->searchable()
                                ->required(),
                            FileUpload::make('audio_path')
                                ->label('Audio file')
                                ->acceptedFileTypes(['audio/*'])
                                ->required(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->orderColumn('sort_order')
                        ->addActionLabel('Add another audio')
                        ->columnSpanFull(),
                ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn (Blog $record) => ! $record->trashed()),
                DeleteAction::make()
                    ->visible(fn (Blog $record) => ! $record->trashed()),
                RestoreAction::make()
                    ->visible(fn (Blog $record) => $record->trashed()),
                ForceDeleteAction::make()
                    ->visible(fn (Blog $record) => $record->trashed()),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
