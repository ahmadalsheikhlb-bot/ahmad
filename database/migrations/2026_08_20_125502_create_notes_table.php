<?php

use App\Enum\NoteStatus;
use App\Enum\NoteVisibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('topic_id')
                ->constrained()
                ->restrictOnDelete();
            $table->string('title');
            $table->longText('content');
            $table->enum('visibility',array_column(NoteVisibility::cases(),'value'))->default(NoteVisibility::PRIVATE->value);
            $table->enum('status',array_column(NoteStatus::cases(),'value'))->default(NoteStatus::Draft->value);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('topic_id');
            $table->index('visibility');
            $table->index('status');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
