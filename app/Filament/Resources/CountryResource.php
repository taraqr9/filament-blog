<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Country;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static string|UnitEnum|null $navigationGroup = 'Locations';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('code')
                    ->label('ISO code')
                    ->placeholder('e.g. IT')
                    ->maxLength(2)
                    ->unique(ignoreRecord: true),
                Select::make('status')
                    ->options(Status::class)
                    ->default(Status::Active)
                    ->required(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Code')
                    ->placeholder('—'),
                TextColumn::make('cities_count')
                    ->label('Cities')
                    ->counts('cities'),
                StatusColumn::make(),
            ])
            ->defaultSort('name')
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function ($record, $action) {
                        if ($record->cities()->exists()) {
                            Notification::make()
                                ->title('Cannot delete country')
                                ->body('This country has cities and cannot be deleted.')
                                ->danger()
                                ->send();

                            $action->cancel();

                            throw new Halt;
                        }
                    }),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
