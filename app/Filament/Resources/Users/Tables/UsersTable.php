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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                // Split::make([

                TextInputColumn::make("name")
                    ->label("Nome")
                    ->searchable()
                    ->sortable()
                    ->rules(["required", "min:10"]),

                ImageColumn::make("avatar")->imageHeight(40)->circular()
                    // ->hiddenFrom('md'),
                    ->visibleFrom('md'),

                // Stack::make([
                TextColumn::make("email")->label("Email")->sortable()
                    ->visibleFrom('md'),

                TextColumn::make("phone")
                    ->label("Telefone")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
                // ]),

                // IconColumn::make("is_admin")
                //     ->label("Admin")
                //     ->boolean()
                //     ->trueIcon(Heroicon::Check)
                //     ->falseIcon(Heroicon::XMark),

                ToggleColumn::make("is_admin")
                    ->label("Admin"),

                TextColumn::make("comments_count")
                    ->label("Comentários")
                    ->sortable()
                    ->counts("comments") // relacionamento com comentários
                    ->badge()
                    ->color(fn($state): string => $state >= 2 ? 'success' : 'danger'),

                TextColumn::make("created_at")
                    ->label("Criado em")
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make("updated_at")
                    ->label("Última atualização")
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                // ])->from('md')
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
