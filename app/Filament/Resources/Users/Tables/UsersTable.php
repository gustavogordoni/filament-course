<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Nome")
                    ->searchable()
                    ->sortable(),

                ImageColumn::make("avatar")->imageHeight(40)->circular(),

                TextColumn::make("email")->label("Email")->sortable(),

                TextColumn::make("phone")
                    ->label("Telefone")
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make("is_admin")
                    ->label("Admin")
                    ->boolean()
                    ->trueIcon(Heroicon::Check)
                    ->falseIcon(Heroicon::XMark),

                TextColumn::make("comments_count")
                    ->label("Comentários")
                    ->sortable()
                    ->counts("comments"), // relacionamento com comentários

                TextColumn::make("created_at")
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make("updated_at")
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()->label("Editar usuário"),
                    DeleteAction::make()->label("Excluir usuário"),
                ])
                    ->icon(Heroicon::Bars3)
                    ->color(Color::Yellow),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
