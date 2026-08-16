<?php

namespace App\Filament\Resources;

use App\Enums\UserStatus;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->placeholder('e.g. John Doe')
                        ->required(),
                    TextInput::make('username')
                        ->alphaDash()
                        ->unique(ignoreRecord: true)
                        ->placeholder('e.g. john_doe')
                        ->helperText('Used to sign in. Must be unique.')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->unique(ignoreRecord: true)
                        ->placeholder('e.g. john.doe@example.com')
                        ->nullable(),
                    TextInput::make('phone')
                        ->tel()
                        ->placeholder('e.g. 01234567890'),
                    Select::make('roles')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->required(),
                    TextInput::make('profession')
                        ->placeholder('e.g. Software Engineer, Teacher, Lawyer')
                        ->columnSpanFull(),
                ])->columns(2),
                Section::make([
                    TextInput::make('password')
                        ->required(fn (?User $record) => ! $record?->exists)
                        ->dehydrated(fn ($state) => ! empty($state))
                        ->password()->confirmed(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->dehydrated(false)
                        ->same('password')
                        ->required(fn (?User $record) => ! $record?->exists)->password(),
                ])->columns(2),
                Section::make([
                    FileUpload::make('avatar')
                        ->nullable()
                        ->image()
                        ->imageEditor(),
                ]),

                Radio::make('status')
                    ->options(UserStatus::class)
                    ->default(UserStatus::Active)
                    ->columns(3)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('roles.name'),
                StatusColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Impersonate::make()
                    ->color('info')
                    ->redirectTo('/admin'),
                EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
