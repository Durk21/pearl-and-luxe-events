<?php
namespace App\Filament\Resources;
use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationIcon = "heroicon-o-video-camera";
    protected static ?string $navigationLabel = "Videos";
    protected static ?string $navigationGroup = "Content";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Video Details")->schema([
                Forms\Components\TextInput::make("title")
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make("event_type")
                    ->label("Event Type")->maxLength(255),
                Forms\Components\TextInput::make("duration")
                    ->label("Duration (e.g. 2:30)")->maxLength(20),

                Forms\Components\Radio::make("video_source")
                    ->label("Video Source")
                    ->options([
                        "url"  => "YouTube / Vimeo URL",
                        "file" => "Upload Video File",
                    ])
                    ->default("url")
                    ->live(),

                Forms\Components\TextInput::make("video_url")
                    ->label("YouTube / Vimeo URL")
                    ->url()
                    ->placeholder("https://www.youtube.com/watch?v=...")
                    ->visible(fn($get) => $get("video_source") === "url"),

                Forms\Components\FileUpload::make("video_path")
                    ->label("Upload Video")
                    ->disk("public")
                    ->directory("videos")
                    ->acceptedFileTypes(["video/mp4","video/webm","video/ogg"])
                    ->maxSize(512000)
                    ->visible(fn($get) => $get("video_source") === "file"),

                Forms\Components\FileUpload::make("thumbnail_path")
                    ->label("Thumbnail Image")
                    ->image()
                    ->disk("public")
                    ->directory("thumbnails")
                    ->imageResizeMode("cover")
                    ->imageCropAspectRatio("16:9"),

                Forms\Components\Toggle::make("is_active")
                    ->label("Show on site")
                    ->default(true),
                Forms\Components\TextInput::make("sort_order")
                    ->numeric()->default(0),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make("thumbnail_path")
                ->disk("public")->label("Thumbnail")->square(),
            Tables\Columns\TextColumn::make("title")->searchable(),
            Tables\Columns\TextColumn::make("event_type")->label("Type"),
            Tables\Columns\TextColumn::make("duration"),
            Tables\Columns\IconColumn::make("is_active")
                ->label("Active")->boolean(),
            Tables\Columns\TextColumn::make("sort_order")->label("Order"),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort("sort_order");
    }

    public static function getPages(): array
    {
        return [
            "index"  => Pages\ListVideos::route("/"),
            "create" => Pages\CreateVideo::route("/create"),
            "edit"   => Pages\EditVideo::route("/{record}/edit"),
        ];
    }
}
