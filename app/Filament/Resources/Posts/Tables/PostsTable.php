<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\ActionGroup;
use Filament\Support\Colors\Color;
use Illuminate\Support\Str;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make("title")
                    ->label("Título")
                    ->searchable()
                    ->sortable()
                    // ->limit(20),
                    ->wrap()
                    ->description(fn(Post $record): string => Str::of($record->content)->limit(60)),

                TextColumn::make("tags.tag_name")
                    ->label("Tags")
                    ->badge()
                    ->color(fn($state): string => in_array($state, ['automotive', 'baby']) ? 'success' : 'danger'),

                // IconColumn::make("is_published")
                //     ->label("Publicado")
                //     ->sortable()
                //     ->boolean()
                //     ->trueIcon(Heroicon::Check)
                //     ->falseIcon(Heroicon::XMark),

                ToggleColumn::make("is_published")
                    ->label("Publicado")
                    ->sortable(),

                TextColumn::make("user.name")
                    ->label("Autor")
                    ->searchable()
                    ->sortable(),

                SelectColumn::make("category_id")
                    ->label("Categoria(s)")
                    ->options(Category::pluck("name", "id")),

                // TextColumn::make("category.name")
                // ->label("Categoria")
                // ->searchable()
                // ->sortable(),

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
