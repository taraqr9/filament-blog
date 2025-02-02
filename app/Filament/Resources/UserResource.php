<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\IdentityType;
use App\Enums\UserStatus;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->email()->unique(ignoreRecord: true)->required(),
                    TextInput::make('phone')
                        ->columnSpanFull()
                        ->tel()->required(),
                ])->columns(2),
                Section::make([
                    TextInput::make('password')
                        ->required(fn(?User $record) => !$record?->exists)
                        ->dehydrated(fn($state) => !empty($state))
                        ->password()->confirmed(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->dehydrated(false)
                        ->same('password')
                        ->required(fn(?User $record) => !$record?->exists)->password(),
                ])->columns(2),
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
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                StatusColumn::make('status')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
