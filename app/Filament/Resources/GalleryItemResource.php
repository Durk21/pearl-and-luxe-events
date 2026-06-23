<?php
namespace App\Filament\Resources;
use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use App\Models\EventType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;
    protected static ?string $navigationIcon = "heroicon-o-photo";
    protected static ?string $navigationLabel = "Gallery";
    protected static ?string $navigationGroup = "Content";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Photo Details")->schema([
                Forms\Components\TextInput::make("title")
                    ->required()->maxLength(255),
                Forms\Components\Select::make("event_type_id")
                    ->label("Event Type")
                    ->options(EventType::pluck("name", "id"))
                    ->searchable()->required(),
                Forms\Components\FileUpload::make("image_path")
                    ->label("Photo")
                    ->image()
                    ->disk("public")
                    ->directory("gallery")
                    ->imageResizeMode("cover")
                    ->imageCropAspectRatio("16:9")
                    ->imageResizeTargetWidth("1280")
                    ->imageResizeTargetHeight("720")
                    ->required(),
                Forms\Components\Toggle::make("is_featured")
                    ->label("Show on homepage")
                    ->default(false),
                Forms\Components\TextInput::make("sort_order")
                    ->numeric()->default(0),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make("image_path")
                ->disk("public")->label("Photo")->square(),
            Tables\Columns\TextColumn::make("title")->searchable(),
            Tables\Columns\TextColumn::make("eventType.name")->label("Event Type"),
            Tables\Columns\IconColumn::make("is_featured")
                ->label("Featured")->boolean(),
            Tables\Columns\TextColumn::make("sort_order")->label("Order"),
            Tables\Columns\TextColumn::make("created_at")
                ->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make("event_type_id")
                ->label("Event Type")
                ->options(EventType::pluck("name", "id")),
            Tables\Filters\TernaryFilter::make("is_featured")->label("Featured only"),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make("mark_featured")
                    ->label("Mark as Featured")
                    ->icon("heroicon-o-star")
                    ->action(fn($records) => $records->each->update(["is_featured" => true]))
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),
                Tables\Actions\BulkAction::make("unmark_featured")
                    ->label("Remove from Featured")
                    ->icon("heroicon-o-x-mark")
                    ->action(fn($records) => $records->each->update(["is_featured" => false]))
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),
            ]),
        ])
        ->defaultSort("sort_order");
    }

    public static function getPages(): array
    {
        return [
            "index"  => Pages\ListGalleryItems::route("/"),
            "create" => Pages\CreateGalleryItem::route("/create"),
            "bulk-upload" => Pages\BulkUploadGalleryItems::route("/bulk-upload"),
            "edit"   => Pages\EditGalleryItem::route("/{record}/edit"),
        ];
    }
}
