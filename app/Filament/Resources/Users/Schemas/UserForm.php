<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $authUser = auth()->user();

        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                DateTimePicker::make('email_verified_at'),

                TextInput::make('password')
                    ->password()
                    ->label('Password Baru')
                    ->dehydrateStateUsing(
                        fn($state) =>
                        filled($state) ? bcrypt($state) : null
                    )
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation) => $operation === 'create')
                    ->helperText('Kosongkan jika tidak ingin mengubah password'),

                Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->relationship(
                        name: 'roles',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            $user = auth()->user();

                            // 🔥 super_admin → boleh assign SEMUA
                            if ($user->hasRole('super_admin')) {
                                return;
                            }

                            // 🟡 superadmin → tidak boleh assign super_admin & superadmin
                            if ($user->hasRole('superadmin')) {
                                $query->whereNotIn('name', ['super_admin', 'superadmin']);
                                return;
                            }

                            // 🔵 admin → tidak boleh assign admin, superadmin, super_admin
                            if ($user->hasRole('admin')) {
                                $query->whereNotIn('name', [
                                    'super_admin',
                                    'superadmin',
                                    'admin',
                                ]);
                                return;
                            }

                            // ⚪ role lain → tidak boleh assign role APAPUN
                            $query->whereRaw('1 = 0');
                        }
                    )
                    ->hidden(fn ($record) => $record && $record->id === auth()->id())
                    ->preload()
                    ->required(),
            ]);
    }
}
