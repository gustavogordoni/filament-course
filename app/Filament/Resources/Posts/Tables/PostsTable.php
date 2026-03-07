<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\ActionGroup;
use Filament\Support\Colors\Color;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")
                    ->label("Título")
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                IconColumn::make("is_published")
                    ->label("Publicado")
                    ->sortable()
                    ->boolean()
                    ->trueIcon(Heroicon::Check)
                    ->falseIcon(Heroicon::XMark),

                TextColumn::make("user.name")
                    ->label("Autor")
                    ->searchable()
                    ->sortable(),

                TextColumn::make("category.name")
                    ->label("Categoria")
                    ->searchable()
                    ->sortable(),

                TextColumn::make("created_at")
                    ->label("Criado em")
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make("updated_at")
                    ->label("Última atualização")
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
