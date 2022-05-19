@servers(['web' => ['ec2-user@ 18.181.195.71']])

{{-- serversで記述した「web」のサーバーを対象に、taskで囲った範囲のコマンドを[foo]として定義して実行する --}}
@task('foo', ['on' => 'web'])
    cd projectfile {{-- ここは環境に合わせて変更する --}}
    git pull git@github.com:sunamoto-mikiya/laravel-tutorial.git
    cp -f .env.production .env
    docker-compose down
    docker-compose -f docker-compose.yml up -d
    docker-compose exec -T php composer install
    docker-compose exec -T php php artisan cache:clear
    docker-compose exec -T php composer dump-autoload
@endtask
