<?php
namespace App\Filament\Resources\GalleryItemResource\Pages;
use App\Filament\Resources\GalleryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryItems extends ListRecords
{
    protected static string $resource = GalleryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("bulk_upload")
                ->label("Bulk Upload Photos")
                ->icon("heroicon-o-arrow-up-tray")
                ->color("success")
                ->url(GalleryItemResource::getUrl("bulk-upload")),
            Actions\CreateAction::make()
                ->label("Add Single Photo"),
        ];
    }
}
