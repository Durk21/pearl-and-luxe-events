<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table("videos", function (Blueprint $table) {
            $table->string("thumbnail_path")->nullable()->change();
            $table->string("video_path")->nullable()->change();
            $table->string("video_url")->nullable()->change();
            $table->string("event_type")->nullable()->change();
            $table->string("duration")->nullable()->change();
        });
    }
    public function down(): void {}
};
