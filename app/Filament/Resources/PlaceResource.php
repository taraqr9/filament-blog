<?php

namespace App\Filament\Resources;

use App\Enums\Language;
use App\Enums\Status;
use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Place;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    protected static string|UnitEnum|null $navigationGroup = 'Locations';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('city_id')
                        ->relationship('city', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),

                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                            if (($get('slug') ?? '') !== Str::slug($old)) {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        })
                        ->required(),

                    TextInput::make('slug')
                        ->required(),

                    Select::make('status')
                        ->options(Status::class)
                        ->default(Status::Active)
                        ->required(),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    RichEditor::make('description')
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),

                Section::make('Images')
                    ->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->imageEditor()
                            ->minFiles(3)
                            ->maxFiles(6)
                            ->helperText('Upload between 3 and 6 images for the place carousel.')
                            ->hiddenLabel(),
                    ]),

                Section::make('Audio Guides')
                    ->description('Add one audio file per language. The visitor picks a language and plays the matching file.')
                    ->schema([
                        Repeater::make('audios')
                            ->relationship('audios')
                            ->schema([
                                Select::make('language')
                                    ->options(Language::class)
                                    ->required(),
                                FileUpload::make('audio_path')
                                    ->acceptedFileTypes(['audio/*'])
                                    ->required()
                                    ->label('Audio file'),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->orderColumn('sort_order')
                            ->addActionLabel('Add another audio')
                            ->hiddenLabel(),
                    ]),

                Section::make('Access')
                    ->description('Only assigned tourists can view this place.')
                    ->schema([
                        Select::make('users')
                            ->relationship('users', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->hiddenLabel(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->getStateUsing(fn (Place $record) => $record->images[0] ?? null)
                    ->label('Cover'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('city.name')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('city.country.name')
                    ->label('Country'),
                TextColumn::make('audios_count')
                    ->label('Audio guides')
                    ->counts('audios'),
                TextColumn::make('users_count')
                    ->label('Assigned users')
                    ->counts('users'),
                StatusColumn::make(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('city')
                    ->relationship('city', 'name'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
