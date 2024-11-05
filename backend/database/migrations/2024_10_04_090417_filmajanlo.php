<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // felhasznalok tábla
        Schema::create('felhasznalok', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 255);
            $table->string('email', 255)->unique();
            $table->string('jelszo', 255);
            $table->string('profilkep_url', 255)->nullable();
            $table->timestamp('regisztracios_datum')->useCurrent();
        });

        // kategoriak tábla
        Schema::create('kategoriak', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 255)->unique();
        });

        // studiok tábla
        Schema::create('studiok', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 255)->unique();
        });

        // szemelyek tábla (általános tábla színészeknek, íróknak, rendezőknek)
        Schema::create('szemelyek', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 255);
            $table->text('ismerteto')->nullable();
            $table->date('szuldatum')->nullable();
            $table->string('profilkep_url', 255)->nullable();
        });

        // szemely_tipusok kapcsoló tábla
        Schema::create('szemely_tipusok', function (Blueprint $table) {
            $table->foreignId('szemely_id')->constrained('szemelyek')->onDelete('cascade');
            $table->enum('tipus', ['szinesz', 'iro', 'rendezo']);
            $table->primary(['szemely_id', 'tipus']);
        });

        // muvek (alaptábla filmeknek és sorozatoknak)
        Schema::create('muvek', function (Blueprint $table) {
            $table->id();
            $table->enum('tipus', ['film', 'sorozat']);
            $table->string('cim', 255);
            $table->foreignId('rendezo_id')->nullable()->constrained('szemelyek')->onDelete('set null');
            $table->foreignId('iro_id')->nullable()->constrained('szemelyek')->onDelete('set null');
            $table->foreignId('kategoria_id')->nullable()->constrained('kategoriak')->onDelete('set null');
            $table->foreignId('studio_id')->nullable()->constrained('studiok')->onDelete('set null');
            $table->text('leiras');
            $table->year('kiadasi_ev');
            $table->string('boritokep_url', 255);
            $table->string('link_netflix', 255);
            $table->string('link_hbo', 255);
        });

        // velemenyek tábla
        Schema::create('velemenyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('felhasznalo_id')->constrained('felhasznalok')->onDelete('cascade');
            $table->foreignId('mu_id')->constrained('muvek')->onDelete('cascade');
            $table->text('velemeny');
            $table->timestamp('datum')->useCurrent();
        });

        // mu_szineszek kapcsoló tábla
        Schema::create('mu_szineszek', function (Blueprint $table) {
            $table->foreignId('mu_id')->constrained('muvek')->onDelete('cascade');
            $table->foreignId('szinesz_id')->constrained('szemelyek')->onDelete('cascade');
            $table->primary(['mu_id', 'szinesz_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mu_szineszek');
        Schema::dropIfExists('velemenyek');
        Schema::dropIfExists('muvek');
        Schema::dropIfExists('szemely_tipusok');
        Schema::dropIfExists('szemelyek');
        Schema::dropIfExists('studiok');
        Schema::dropIfExists('kategoriak');
        Schema::dropIfExists('felhasznalok');
    }
};
