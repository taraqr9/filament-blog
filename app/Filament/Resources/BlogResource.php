<?php

namespace App\Filament\Resources;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Table\Columns\BlogStatusColumn;
use App\Models\Blog;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $hasTitleCaseModelLabel = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                            if (($get('slug') ?? '') !== Str::slug($old)) {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        })
                        ->required(),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->createOptionForm([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->live(onBlur: true)
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
                                        ->required(),

                                    TextInput::make('slug')
                                        ->required(),
                                ]),
                            RichEditor::make('description')
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->preload()
                        ->searchable()
                        ->required(),
                    Select::make('status')
                        ->options(BlogStatus::class)
                        ->default(BlogStatus::Published)
                        ->required(),
                    TextInput::make('slug')
                        ->required(),
                    FileUpload::make('thumbnail')
                        ->nullable()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                ])->columns(2),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Checkbox::make('send_mail')
                    ->label('Send mail to all subscribers')
                    ->hidden(fn (?Model $record) => filled($record?->published_at)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                BlogStatusColumn::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('Category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
