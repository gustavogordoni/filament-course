<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getTabs(): array
    {
        return [
            "Todos" => Tab::make("Todos as postagens")->icon(Heroicon::Home),
            "Publicados" => Tab::make("Publicadas")
                ->query(fn($query) => $query->where("is_published", true))
                ->icon(Heroicon::Check)
                ->badge(
                    fn() => static::getModel()
                        ::where("is_published", true)
                        ->count(),
                )
                ->badgeColor(
                    fn() => static::getModel()
                        ::where("is_published", true)
                        ->count() > 10
                        ? "success"
                        : "warning",
                ),
            "Não publicados" => Tab::make("Não publicadas")
                ->query(fn($query) => $query->where("is_published", false))
                ->icon(Heroicon::XMark)
                ->badge(
                    fn() => static::getModel()
                        ::where("is_published", false)
                        ->count(),
                )
                ->badgeColor(
                    fn() => static::getModel()
                        ::where("is_published", false)
                        ->count() > 10
                        ? "warning"
                        : "success",
                ),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
