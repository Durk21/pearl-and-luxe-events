<?php
namespace App\Filament\Resources\GalleryItemResource\Pages;
use App\Filament\Resources\GalleryItemResource;
use App\Models\EventType;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;

class BulkUploadGalleryItems extends Page
{
    protected static string $resource = GalleryItemResource::class;
    protected static string $view = "filament.resources.gallery-item-resource.pages.bulk-upload";
    protected static ?string $title = "Bulk Upload Photos";
    protected static ?string $navigationIcon = "heroicon-o-arrow-up-tray";

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Bulk Upload")->schema([
                Forms\Components\Select::make("event_type_id")
                    ->label("Event Type (applies to all photos)")
                    ->options(EventType::pluck("name", "id"))
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make("is_featured")
                    ->label("Mark all as Featured")
                    ->default(false),
                Forms\Components\FileUpload::make("images")
                    ->label("Select Photos")
                    ->image()
                    ->multiple()
                    ->disk("public")
                    ->directory("gallery")
                    ->imageResizeMode("cover")
                    ->imageCropAspectRatio("16:9")
                    ->imageResizeTargetWidth("1280")
                    ->imageResizeTargetHeight("720")
                    ->maxFiles(50)
                    ->panelLayout("grid")
                    ->required(),
            ]),
        ])->statePath("data");
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $count = 0;

        foreach ($data["images"] as $path) {
            GalleryItem::create([
                "title"         => "Photo " . ($count + 1),
                "event_type_id" => $data["event_type_id"],
                "image_path"    => $path,
                "is_featured"   => $data["is_featured"] ?? false,
                "sort_order"    => 0,
            ]);
            $count++;
        }

        Notification::make()
            ->title("Success! {$count} photos uploaded.")
            ->success()
            ->send();

        $this->redirect(GalleryItemResource::getUrl("index"));
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make("back")
                ->label("Back to Gallery")
                ->url(GalleryItemResource::getUrl("index"))
                ->color("gray"),
        ];
    }
}
