//initiate
1. composer update
1. composer install
2. composer update
3. php artisan storage:link
4. cp .env.example .env (buat munculin file .env nya)
5. php artisan key:migrate (buat bikin secret code)
6. isi file .env supaya ngikutin database kamu
7. php artisan migrate



//config env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database_maneh
DB_USERNAME=postgres
DB_PASSWORD=password_maneh

<!-- ------- -->
use HasFactory;
    public $guarded = ['id'];
    protected $table = 'admin';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Admin $admin) {
            $admin->password = Hash::make($admin->password);
        });
        static::updating(function (Admin $admin) {
            if ($admin->isDirty(["password"])) {
                $admin->password = Hash::make($admin->password);
            }
        });
    }