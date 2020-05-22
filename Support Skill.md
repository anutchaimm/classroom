============================================================================================================
[Installation]

## Via Composer Create-Project
1. คำสั่งที่ไว้สำหรับสร้าง Project ของ Laravel
composer create-project --prefer-dist laravel/laravel blog
** คำว่า blog สามารถเปลี่ยนได้นั้นคือชื่อ Project

Local Development Server
2. คำสั่งไว้รัน Project มีลักษณะเหมือนการพิม localhost
php artisan serve

Public Directory
3. หลังจากที่ติดตั้งเสร็จ เว็บหน้าแรกสุดจะอยู่ โฟลเดอร์ resources/welcome.blade.php

Configuration Files
4. การตั้งค่าทุกอย่างใน Laravel จะถูกเก็บที่ไฟล์ config

Directory Permissions
5. ถ้าคุณต้องการจะเซ็ต Permission จะอยู่ที่ folder bootstrap/cache

## Application Key
6. หลังจากที่ติดตั้ง Laravel เสร็จควรมีการ Gerate Key ขึ้นมาโดยใช้คำสั่ง php artisan key:generate
* ถ้าเราไม่ได้เซ็ตไว้ session และการเข้ารหัสใด ๆ จะไม่ปลอดภัย

Additional Configuration
7. จริง ๆ เราไม่ต้องตั้งค่าอะไรที่มันนอกจากที่ Laravel แนะนำจะมีเช่น Cache Database Session ก็ทำงานได้ปกติ แต่ถ้าหากต้องการปรับเพิ่มก็สามารถทำได้โดยไปที่ config/app.php อย่างเช่นไปตั้งค่า timezone หรือ locate เป็นต้น
============================================================================================================

Web Server Configuration 
(ไม่ขออธิบาย)

============================================================================================================
[Configuration]

Maintenance Mode
8. ในกรณีที่เราต้องการอัพเดท Program หรือระบบ สามารถใช้คำสั่ง 
php artisan down --message="Upgrading Database" --retry=60
จะแสดงข้อความ Urgrading Database ให้กับคนที่เข้ามาดูระบบ

9. ในตอนที่กำลังอัพเดท สามารถกำหนด IP ที่ยังสามารถเข้าใช้ได้อยู่หรืออนุญาตให้เข้าได้ โดยใช้คำสั่ง 
php artisan down --allow=127.0.0.1 --allow=192.168.0.0/16

10. หลังจากที่อัพเดทเสร็จแล้วให้ต้องการจะเปิดระบบให้ใช้ปกติ ใช้คำสั่ง
php artisan up

* เราสามารถไปตั้งค่า เริ่มต้มตอนที่มันกำลัง Maintenance ที่ไฟล์ resources/views/errors/503.blade.php
============================================================================================================

Directory Structure
(ไม่ขออธิบายทั้งหมดเพราะเยอะมาก)

============================================================================================================

Laravel Homestead
(มันถึงการเซ็ตบน Server ซึ่งอาจารย์ก็ไม่เข้าใจเลยไม่อธิบายเดี๋ยวผิด)
## ถ้าเครื่อง Dev ให้ลงแค่ XAMPP Composer NodeJS ก็สามารถทำงานได้แล้ว

Laravel Valet
(คล้ายกับ Laravel Homestead แต่อันนี้สำหรับเครื่อง MAC)

============================================================================================================

Deployment
(ในเอกสารพูดถึงเรื่องการนำไปติดตั้งบนเครื่องที่ทำงานจริงหรือเรียกว่า Production โดย Web Server ที่ Laravel แนะนำคือ NGinX)

============================================================================================================

[Request-Lifecycle]

## คำคม บอกว่าถ้าเราเข้าใจ Concept มันดีแล้วเนี่ยเราจะรู้สึกสบายใจเวลาเขียนและเชื่อมั่นในตัวเองมากขึ้น

First Things
สิ่งแรกที่ต้องรู้คือ การเข้าถึง แอปพลิเคชัน จะผ่านไฟล์ public/index.php เสมอ โดยคำขอทั้งหมดจะถูกส่งตรงไปที่ ไฟล์นี้จาก web server ของคุณเอง (Apache/Nginx) ในไฟล์ index.php จะไม่ได้เก็บ code อะไรมากมาย แค่ไว้โหลดส่วนต่าง ๆ ของ framework มาใช้งาน โดยสิ่งที่โหลดมาคือ สิ่งที่ composer สร้างไว้ให้

HTTP / Console Kernels
ส่วนถัดไป คำขอกหรือ request จะที่ถูกส่งไปทั้งที่ HTTP Kernel หรือ Console Kernel มันขึ้นอยู่กับประเภทของขอ request นั้น ๆ ว่ามันจะไปที่ application ใด โดย kernel ทั้งสองอย่างนี้จะทำหน้าที่เป็นศูนย์กลาง จาก request ที่ถูกส่งเข้ามาทั้งหมด 
* แต่ตอนนี้ให้เรา โฟกัสที่ HTTP Kernel อย่างเดียวก็พอ มันถูกเก็บที่ app/Http/Kernel.php

นอกจากนี้ HTTP kernel สืบทอดมาจาก Illuminate\Foundation\Http\Kernel  คลาสนั้นเอง โดยวิธีการทำงานของมันง่าย ๆ คือ จะรับ request มาแล้วส่ง response กลับไป

Service Providers
เป็นส่วนหนึ่งที่สำคัญมากของ Kernel bootstrapping ที่มันกำลัง load service providers สำหรับ แอปพลิเคชันของเรา โดยเราสามารถไปตั้งค่ามันได้ที่ไฟล์ config/app.php 

Dispatch Request
เมื่อ แอปพลิเคชัน ได้ทำการบูตการทำงาน และ service providers มีการลงทะเบียนแล้ว Request จะถูกส่งไปที่ route เพื่อการจัดส่งเส้นทาง
การ route จะจัดส่งเส้นทางของคำขอหรือ request ไปที่ controller เช่นเดียวกับ การทำงานเรียกใช้ middleware นั้น ๆ

Focus On Service Providers
Service Providers มันเป็นหัวใจหรือคีย์หลักในการ boot การทำงานของ แอปพลิเคชันที่สร้างจาก Laravel
การที่เราเข้าใจเป็นอย่างดีว่า application จะถูกสร้างและ บูตผ่าน service providers เป็นเรื่องที่มีคุณค่ามาก

============================================================================================================

[Service-Container]

โดย Service container ของ Laravel เนี่ยเป็นเครื่องมือที่ทรงพลังมากในการจัดการ คลาสต่าง ๆ 
Let's look at a simple example: (ลองดูตัวอย่างต่อไปนี้)

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;

class UserController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);

        return view('user.profile', ['user' => $user]);
    }
}

จากตัวอย่างนี้ UserController จะเป็นต้องดึงข้อมูลของ users จาก แหล่งเก็บข้อมูล ดังนั้น เราเลยจะต้อง Inject service ให้มันสามารถดึงข้อมูล user ได้ นอกจากนี้ในส่วนของ เนื้อหา UserReposity ส่วนใหญ่จะใช้ Eloquent ที่จะไว้ดึงข้อมูล user จากฐานข้อมูลหรือ Database

การเข้าใจแบบมาก ๆ ของ Laravel service container มันสำคัญมาก เพื่อตอนที่สร้าง application ที่มีขนาดใหญ่ ๆ มันจะสนับสนุนการทำงานให้ง่ายยิ่งขึ้น

Binding
เกือบทั้งหมดของ การผูกหรือ bindings จะถูกลงทะเบียน ภายใน service providers 

Simple Bindings
ภายใน service provider เราจะมีการเข้าถึง container ผ่าน $this->app เสมอ
เราสามารถลงทะเบียน binding โดยการใช้ bind method ผ่านไปที่คลาส หรือ ชื่อ interface ซึ่ง เราจะลงทะเบียนไปพร้อมกับ Closure มันจะส่งค่า instance ของ class นั้นกลับมา

Binding A Singleton
Binding Instances
Binding Primitives
Binding Interfaces To Implementations
Contextual Binding
Tagging
Extending Bindings
Resolving
Automatic Injection
Container Events
PSR-11
## ส่วนอื่น ๆ ไม่ขออธิบายเพราะไม่เข้าใจว่า Bindings คืออะไรเว้นไว้ก่อน

============================================================================================================

[Service-Providers]
[Facades]
[Contracts]

============================================================================================================

[Routing]

## Basic Routing

ส่วนที่พื้นฐานที่สุดของ Laravel คือการสร้างเส้นทางในการเข้าถึง URL นี่เป็นตัวอย่างดีที่มากในการเริ่มเรียนรู้การ Routing หรือกำหนดเส้นทางดังตัวอย่างต่อไปนี้

Route::get('foo', function () {
    return 'Hello World';
});

โค้ดนี้ให้เอาไปวางที่ไฟล์ web.php ที่อยู่ใน folder routes

โดยสรุปง่ายคือ เมื่อเราพิมเส้นทางที่ชื่อว่า foo เช่น http://127.0.0.1/login/public/foo จะทำงาน function ข้างล่าง
โดยจะส่งคำว่า Hello Wordld กลับมา


## Available Router Methods
นี่คือ method ของการกำหนดเส้นทางทั้งหมด

Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);

ในบางครั้งเราจะต้องใช้หลาย Method ซึ่งเราสามารถใช้วิธีการแบบนี้ได้

Route::match(['get', 'post'], '/', function () {
    //
});

Route::any('/', function () {
    //
});

## CSRF Protection

ทุกรูปแบบของ Form html ที่สั่ง method เช่น post, put, delete จะถูกกำหนดในไฟล์ web.php ซึ่งจะต้อง include คำสั่ง CSRF token field มาด้วย
ไม่อย่างนั้น ทุกคำร้องหรือ Request จะถูกยกเลิกทั้งหมด

<form method="POST" action="/profile">
    @csrf
    ...
</form>

## สำคัญในฟอร์มส่งข้อมูลทุกครั้งต้องใส่คำสั่ง @crsf เสมอ


# Redirect Routes

ถ้าเรากำลังจะที่กำหนดเส้นทางไป URL อื่น ๆ เราจะต้องใช้ คำสั่ง Route::redirect method โดย method นี้จะให้ทางลัดที่ง่าย ดังนั้น 

Route::redirect('/here', '/there');

ส่วนใหญ่เราจะเขียนคำสั่ง redirect ไว้ที่พวกไฟล์ Controller เพื่อให้มันกลับไปลิ้งค์ใด ๆ

โดยค่าเริ่มต้น มันจะส่ง โค้ด 302 กลับให้เรา แต่เราสามารถกำหนดได้ในพารามิเตอร์ตัวที่ 3
Route::redirect('/here', '/there', 301);

หรือใช้แบบนี้ Route::permanentRedirect method เพื่อส่ง 301 ก็ได้

Route::permanentRedirect('/here', '/there');

# View Routes

ถ้าเราต้องการกำหนดเส้นทางเพื่อดูเท่านั้นสามารถใช้ครับสั่ง Route::view ได้เลย ซึ่งมันเหมือนกับคำสั่ง redirect method นั้นหล่ะ เพราะฉะนั้นเราจะไม่ต้องกำหนดรูปแบบเต็ม ๆ ไปที่ controller 

Route::view('/welcome', 'welcome');

พารามิเตอร์ตัวแรกคือชื่อ path ไว้ใส่ตรง URL ตัวที่สองคือ ชื่อไฟล์ เช่น welcome.blade.php  
แต่ในที่นี้ให้เรียกเฉพาะชื่อด้านหน้าสุดไม่ต้องเรียก .blade ด้วย


Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

สำหรับ พารามิเตอร์ตัวที่สามคือ สามารถส่งข้อมูลแบบอาเรย์ไปด้วยได้

วิธีการดู ให้ใส่คำสั่งนี้ {{ $name }} ที่หน้า welcome.blade.php

# Route Parameters

ในบางครั้งที่เราต้องการส่งค่า แบบ get เช่น user/10 เราก็สามารถทำได้ตามคำสั่งนี้

Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});

และฝั่งขารับตรง function ก็สร้าง parameter id มารับค่าจาก get ที่ส่งมาแสดง

นอกจากนี้เรายังสามารถส่งทีละหลายตัวได้ แต่มันจะนับที่เป็น get เฉพาะตัวที่อยู่ในเครื่องหมาย {} เท่านั้นดังตัวอย่าง

Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});

ให้สังเกตุที่ฟัง พารามิเตอร์ที่รับของ Function 

# Optional Parameters

ในบางครั้งที่ User อาจจะไม่ได้ส่งค่า ไอดีมาให้เรา ให้เราใช้เครื่องหมาย ? ต่อท้ายดักไว้ มันจะทำให้โปรแกรมเราไม่ Error
และฝั่งขารับ จะกำหนดค่า John ให้แทนเลย

Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});


# Regular Expression Constraints

ในบางครั้งที่ต้องการกำหนดรูปแบบ ค่าตัวแปรที่ส่งมาจาก URL เราสามารถใช้คำสั่ง where เขียนต่อท้ายได้

Route::get('user/{name}', function ($name) {
    //
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);


# Global Constraints

วิธีง่าย ๆ ในการกำหนด Regular Expression ให้ทุกครั้งที่เราจะใช้มัน ให้ไปแก้ไขที่ Folder app>>providers>>routeserviceprovider.php
และใส่คำสั่งนี้ route::parttern ที่ฟังก์ชัน boot ซะ

public function boot()
{
    Route::pattern('id', '[0-9]+');

    parent::boot();
}

พอเราเสร็จแบบนี้เสร็จทุกครั้งที่เราใช้ route มันจะเช็ค regular expresion ให้เราเลย ไม่ต้องทำซ้ำอีก

# Encoded Forward Slashes

ในการส่งค่านั้นอย่าส่งเครื่องหมาย / ไปด้วย Laravel จะไม่ยอม

# Named Routes

มันคือการตั้งชื่อ ของการ Routes นั้น ๆ มันมีประโยชน์เวลาที่เราจะ redirect กลับไปที่เส้นทางดังกล่าว ให้เรียกว่าชื่อ ที่เราตั้งได้เลยไม่งั้นจะงง และยากด้วยเวลาจะ redirect กลับ
โดยมีวิธีการตั้ง 2 แบบ

แบบไม่ผ่าน Controller
Route::get('user/profile', function () {
    //
})->name('profile');

แบบผ่าน Controller
Route::get('user/profile', 'UserProfileController@show')->name('profile');

** การต้องชื่อ route ห้ามตั้งชื่อซ้ำกันเด็ดขาด

# Generating URLs To Named Routes

แบบแรกคือการตั้งค่าตัวแปร $url = route('profile'); จะได้สามารถนำไปใช้ได้หลายที
// Generating URLs...
$url = route('welcome');
return redirect($url);

แบบที่สองคือ เรียกให้ไป redirect ไปที่ชื่อ เส้นทางนั้น ๆ เลย
// Generating Redirects...
return redirect()->route('welcome');

ในกรณีที่ 3 คือ เราสามารถใส่ ค่า พารามิเตอร์ต่อจากชื่อเส้นทาง profile ได้เลยตามตัวอย่าง

$url = route('profile', ['id' => 1]);

Route::get('user/{id}/profile', function ($id) {
    //
})->name('profile');

ในกรณที่ 4 มันยังสามารถใส่ ค่าพารามิเตอร์ ได้มากกว่า 1 ตัว
Route::get('user/{id}/profile', function ($id) {
    //
})->name('profile');

$url = route('profile', ['id' => 1, 'photos' => 'yes']);

อันนี้คือตัวอย่างผลลัพธ์ ที่จะแสดงบน URL
// /user/1/profile?photos=yes

# Inspecting The Current Route
คือถ้าต้องการตรวจสอบชื่อของ route นั้นเองสามารถทำได้จาก route middleware

public function handle($request, Closure $next)
{
    if ($request->route()->named('profile')) {
        //
    }

    return $next($request);
}

<!-- !ยังไม่ค่อยเข้าใจ -->

** ตรงนี้ยังไม่เข้าใจ Route middleware คืออะไร
middleware มีหน้าที่ไว้สำหรับกรองข้อมูลหรือ request ที่ถูกส่งเข้ามา เราสามารถสร้าง middleware ขึ้นมาใช้เองได้
โดย 1 middleware จะมีแค่ 1 function closure หมายถึงว่าเมื่อผ่านกระบวนการ validation เสร็จแล้วจะให้มันส่งไปที่ไหนต่อ

[Route-Groups]

# Middleware
เพื่อสั่ง middleware เส้นทางทั้งหมด ภายในกลุ่ม เราอาจจะใช้ คำสั่งนี้ก่อนจะกำหนด group middlerware จะถูกทำงานใน


Namespace คือไว้ใช้สำหรับเวลาที่ชื่อคลาสมันซ้ำกัน โดยมันจะถูกทำงานตามลำดับ

<!-- !ยังไม่ค่อยเข้าใจ -->

Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});



# Namespaces
กรณีทั่วไปอื่นๆ สำหรับการกำหนดเส้นทางที่กำลังจะกำหนด ชื่อ PHP namespace เหมือนกัน ไปที่กลุ่มของ controller 
Route::namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
});

<!-- !ยังไม่ค่อยเข้าใจ -->

# Route Prefixes
ฟังก์ชัน prefix อาจจะถูกใช้ เพื่อเติมคำนำหน้าให้ แต่ละเส้นทางในกลุ่ม

Route::prefix('admin')->group(function () {
    Route::get('users', function () {

        return '555';

        // Matches The "/admin/users" URL
    });

        Route::get('users1', function () {

        return '666';

        // Matches The "/admin/users1" URL
    });
});


<!-- ? Route Name Prefixes -->

Route::name('admin.')->group(function () {
    Route::get('users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});

<!-- !ยังไม่ค่อยเข้าใจ ว่ามันเรียกยังไงเพราะลองทำแล้ว -->

<!-- ? Fallback Routes -->

Route::fallback(function () {
    return 'หาใครไม่เจออ่ะสิ';
});

ไว้สำหรับไม่มีเส้นทาง จะเด้งมาที่นี้
============================================================================================================


============================================================================================================

## ใน Visual Code สามารถ Terminal หรือ Command Line ได้มากกว่า 1 ตัว

php artisan serve --port=80

43:48 
Alt+J on Windows

ขั้นตอนทำ Login
php artisan make:auth
Version 7 ใช้เป็น
Solution:
Run :composer require laravel/ui
1. composer require laravel/ui
2. php artisan ui vue --auth
3. npm install && npm run dev

หลังจากนั้นให้ไป ตั้งค่าชื่อ Database ที่ไฟล์ .env
และไปสร้าง Database ใน phpmyadmin ตั้งชื่อให้ตรงกับในไฟล์ .env

และทำการ สร้าง table โดยการใช้คำสั่ง
php artisan migrate

freeCodeCampLogo.svg เอามาจาก
https://gist.github.com/Deftwun/e3756a8b518cbb354425?short_path=be2ec54


class="pr-3" pl-3 คือ padding ขวา ซ้าย 3

.row>.col-3 แล้วกด Enter เป็นการเซ็ตให้ Auto

ml-4 margin-left

class="d-flex" การทำให้มันอยู่บรรทัดเดียวกัน

crlt+shift+f การค้นหาไฟล์แบบเร็ว

sass app.scss ไว้กำหนด พวก Fonts และ Variable ไว้กำหนดตัวแปร ที่ไฟล์ _variables.scss

https://fonts.google.com/
ไว้สำหรับหา Font

npm run dev ใหม่อีกครั้ง คือการ Re-compound ของ Font-end

class="w-100 p-3" กำหนด width 100% และ padding 3


 return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

การตรวจสอบข้อมูล


php artisan tinker
User:: all();
ไว้สำหรับดูข้อมูลใน Database

php artisan migrate:fresh คือการ migrate โดยการลบของเดิมออกให้หมด

ที่ไฟล์ model เรื่อง fillable คือการอนุญาติให้ใส่ข้อมูลส่วนนั้น ๆ

php artisan help make:controller
คือการดูว่าจะใช้ยังไง

## Laravel REST FUll Controller
https://laravel.com/docs/5.1/controllers
ไว้สำหรับดูว่าควรใช้ แบบไหนดี


use App\User;
คือการเรียกใช้ Model นั้น 

dd(User::find($user));
 //มันไปวิ่งหาตาม ID


php artisan make:model Profile -m
คำสั่งการสร้าง Model และ สร้าง Migrate

belongsTo() คือ

hasOne() คือ

ืnamespace คือ

$profile = new \App\Profile(); 
ไว้นับจำนวนคลาส

php artisan tinker
>>> $profile = new \App\Profile();
=> App\Profile {#3060}
>>> $profile->title = 'Cool Title';
=> "Cool Title"
>>> $profile->description = 'Description';
=> "Description"
>>> $profile->user_id = 1;
=> 1
>>> $profile->save();

มันคือกระบวนการเพิ่ม ข้อมูลลง Database
$profile->user;
$profile
ไว้เรียกดู Relation
$user = App\User::find(1);
$user->profile

$user->save();
ไว้บันทึกใหม่ทั้งหมด
$user->push();
ไว้สำหรับยัดใส่


{{$user->profile->url ?? 'N/A'}}
?? แปลว่า หรือ


## การสร้าง Relation
    public function posts(){
        return $this->hasMany(Post::class);
    }
    //การสร้าง Relation
one to many

    public function profile(){
        return $this->hasOne(Profile::class);
    }
one to one

<!-- ! การเรียกใช้ Relation {{ dd(Auth::user()->profile->prf_imgcover) }} -->

justify-content-between ทำให้ตัวหนังสือมาห่างกัน

เวลาจะพิม Tag ใน HTML ให้พิม ชื่อตรง ๆ เลย เช่น Input ไม่ต้อง พิมเครื่องหมาย < ก่อน

ส่วนใน css ให้พิม .ตามด้วยชื่อคลาส เช่น .row 


## ไว้สำหรับการ กรอก Request โดยให้มันส่งไปที่ middleware auth สำหรับดักจับยูสเซอร์
    function __construct()
    {
        $this->middleware('auth');
    }

##php artisan storage:link  คือคำสั่งให้มันสร้าง Folder storage ที่ Folder public อารมร์แบบสร้าง Shortcut

## $imagePath =  $request->file('image')->store('uploads', 'public');

$filePath =  $request->file('customfile')->store('files/'.$id, 'public');

'files/'.$id คือการเก็บแบบ Sub Folder

php artisan help tinker // ดู Help

PHP artisan tinker  ตามด้วย Post::truncate(); เคลียฐานข้อมูล 

$user = User::find(1); // การสร้าง Model User

$user->role // การตรวจสอบ Relation

composer require intervention/image  มันเป็น Library ไว้จัดการกับพวกรูปภาพ
พอติดตั้งเสร็จ



<!-- TODO ไว้ทำ Path รูป -->
{{asset('storage')}}/{{$data->prf_img}}
{{asset('storage/profiles/img2.jpeg')}}

<!-- ! Function ไว้เช็ค user -->
{{ Auth::user()->name }}

ให้ใช้คู่กับ Library ตัวนี้
use Intervention\Image\ImageManagerStatic as Image;

<!-- TODO ไปที่ไฟล์ config-> app.php -->
'providers' => [ 
    Intervention\Image\ImageServiceProvider::class,

'aliases' => [
    'Image' => Intervention\Image\ImageServiceProvider::class,

//การปรับขนาดไฟล์รูปภาพ
$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
$image->save();



PUT คือ Insert
PATCH คือ Update

@method ('PATCH')
ประกาศไว้ในฟอร์มข้างล่าง @crsf
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


 value="{{ old('title') }}" แปลว่า เมื่อไม่ผ่าน Validation จะกลับมาเป็นค่าเดิมให้


## มันคือการเขียน Policy ว่าใครสามารถใช้ Function Update ได้บ้าง
1.php artisan make:policy ProfilePolicy -m Profile
สร้างไฟล์ policy

กำหนดค่าในฟังก์ชัน
    public function update(User $user, Profile $profile)
    {
        //
        return $user->id == $profile->user_id;
    }
นำมาตรวจสอบ ใน Controller
 $this->authorize('update', $user->profile);

นำมาใช้ใน View หรือ FrontEnd
@can ('update', $user->profile)
    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
@endcan

## ในกรณีที่ชื่อ Route มันคล้าย ๆ กันต้องทำการเรียงลำดับก่อนหลัง ไม่งั้นมันจะทำงานไม่ได้

Bofore

Route::get('/p/{post}', 'PostController@show')->name('post.show');
Route::get('/p/create', 'PostController@create')->name('post.create');
Route::post('/p', 'PostController@store')->name('post.store');

After

Route::get('/p/create', 'PostController@create')->name('post.create');
Route::post('/p', 'PostController@store')->name('post.store');
Route::get('/p/{post}', 'PostController@show')->name('post.show');


## function boot

เขียนที่ ไฟล์ User.Model
  protected static function boot()
    {
        //
        parent::boot();
        static::created(function ($user){
            $user->profile()->create([
                'title' => $user->username,
                'image' => 'profile/logo.jpg',
            ]);
        });
    }
มันจะบูต เมื่อมีการสร้าง User ใหม่ แล้วมันจะไปสร้าง profile เบื้องให้นะค้าบบบ

ยังไม่ค่อยเข้าใจแต่คิดว่ามันน่าจะ ทำงานครั้งแรกสุดให้


## ไว้สำหรับทำเช็ครูปในกรณีที่เข้าใช้ครั้งแรก

    public function profileImage(){
        $imagePath = ($this->image) ? $this->image : 'profile/logo.jpg';

        return '/storage/'.$imagePath;
    }

    สร้างไว้ที่ไฟล์ Profile

    {{$user->profile->profileImage()}}

    นี้สำหรับตัวเรียกใช้งาน


## หลังจากที่ได้สร้างปุ่ม
ให้ไปตั้งชื่อ ที่ resources > js > components เป็น
FollowButton.vue

แล้วก็ไปแก้ไข componet ที่ไฟล์ resources > js > app.js
Vue.component('follow-button', require('./components/FollowButton.vue').default);

แล้วก็วนกลับไปที่ไฟล์ FollowButtons
copy tag button มาสร้างเป็น Template

จากนั้น npm run watch

<follow-button></follow-button>  มันคือ tag ที่ถูกสร้างขึ้นจาก Vue

แนะนำให้โหลด Extension ของ Vue.js มาใช้ด้วย

ประโยชน์มันคือการสร้าง ปุ่มให้เป็น tag ใหม่แล้วเรียกใช้งานได้และเวลาแก้ก็ไปแก้แค่ที่เดี๋ยว


<button class="btn btn-primary ml-4" @click="followUser">Follow Me</button>

Route::post('follow/{user}', function(){
    return ['success'];

});

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            followUser(){
                //alert('inside');
                axios.post('/follow/1')
                    .then(respone => {
                        alert(respone.data);
                    });
            }
        }
    }

มันการคือรับส่งค่าระหว่าง Vue.Js และ Route web.php

php artisan make:migration creates_profile_user_pivot_table --create profile_user

php artisan make:model Settings -m

ยังไม่รู้มันทำอะไรได้

composer require laravel/telescope

php artisan telescope:install

http://127.0.0.1:8000/telescope/requests

php artisan migrate


RouteServiceProvider
เป็นต้วกำหนด Path Login Home

https://mailtrap.io/

php artisan make:mail NewUserwelcomeMail -m emails.welcome-email
============================================================================================================

## Extension
1. Material Theme, Material Icon Theme
เพิ่ม ไอคอนสวย ๆ

2. Prettier - Code formatter
เวลาเรา Save งานมันจะจัด Format Code ให้

3. Bracket Pair Colorizer 2
ช่วยหา คู่ tag ของมัน

4. indent-rainbow
มันช่วยสร้างสีให้อ่านโค้ดง่ายขึ้น

5. Auto Rename Tag
เวลาเราเปลี่ยนชื่อ tag มันจะเปลี่ยนเป็นคู่เลย

6. REST Client
ไว้สำหรับ get http แล้วมันจะแสดงภาพให้เห็นเลย

7. CSS Peek
ไว้ดูเลยว่า Class มันใช้ CSS อะไรบ้าง

8. HTML CSS Support
เวลาที่เราสร้างคลาสใน CSS แล้วในตอนพิม HTML มันดึงใช้ง่ายขึ้น

9. Live Sass Compile
เวลาเราแก้โค้ดที่ Sass มันจะ Auto

10. Live Server
เวลาเราแก้โค้ด มันไม่ต้อง Refresh ให้กด Go Live ข้างล่างด้วย

11. emmet
คือการพิมย่อ ๆ เช่น
! เท่าโครงสร้าง html
h1 จะได้ tag เต็มมาเลย
p.main-content จะได้ tag p และ class main-content
https://docs.emmet.io/abbreviations/syntax/

12. Ctrl+P ไว้เปิดไฟล์ แบบไว ๆ


13. Alt+f12 ไว้หาที่มาที่ไป

14. Better Comments
เวลา Comment จะเป็นสี

เครื่องมือทำเว็บ

5:30   Affinity Photo (Photo Editing)
5:45   GIMP (Photo Editing)
6:15   Pexels (for photos)
6:53   Unsplash.com (for photos)
6:56   Placeholder.com (for placeholder images)
7:36   tinypng.com (compress images)
8:08   Figma (design websites)
8:57   UI Gradient & Coolors (websites for color palettes)
9:12   DaVinci Resolve (videos for browser)
9:38   Font Awesome & iconmonstr (for icons)
10:02  Undraw (for free illustrations)


15. https://w3alert.com/laravel-tutorial สอน Laravel


16. https://www.youtube.com/watch?v=cPGhs94Rj5E  ทำแชท
https://www.youtube.com/watch?v=5sXmfwnxfjA


Plugin ทำตัวอัพโหลด ชื่อ dropzoneJs

TinyMCE ทำตัวอักษร หนา เอียง ได้

DisQus Comment ไว้ทำคอมเม้นต์ใต้ คอนเท้น

PUTTY คือ

Chart.Js ไว้ทำ Chart


<!-- ! ใน Laravel เวลาส่งค่าจาก Route ชื่ออะไร Function Parameter ก็ต้องรับชื่อนั้นด้วย -->

<!-- ! เวลาส่ง Form ไปให้ Request ตรง Input ต้องมีชื่อเสมอ -->

<!-- TODO การ Route แบบแนบ parameter -->
 <form action="{{route('profile.update', ['id' => $data->user_id])}}" method="post" enctype="multipart/form-data">

 <!-- TODO การ -->


<!-- ? การทำ Seeding -->
use Illuminate\Support\Facades\DB;

ใส่ที่ FOlder Database -> Seed 
        DB::table('classroom_types')->insert([[
            'cls_type' => 1,
            'clst_name' => 'League Learning',
            'clst_status' => 'Available'
        ],
        [
            'cls_type' => 2,
            'clst_name' => 'Tranditional',
            'clst_status' => 'Available'
        ]
    ]);

php artisan migrate:refresh --seed


<!-- ? Eloquent: Getting Started -->
    // protected $keyType = 'string'; ถ้าต้องการให้ Primary Key คือ ไม่ใช่ Integer
    // public $timestamps = false; อันนี้ถ้าไม่ต้องการ Timesstaps
    // protected $dateFormat = 'U'; ถ้าต้องการเซ็ต Format

    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';    ในกรณีที่ต้องการตั้งชื่อ Created at กับ update at ใหม่

    // protected $connection = 'connection-name'; ถ้าต้องการระบุการเชื่อมต่อที่ต่างจากของเดิมที่มีอยู่

    // protected $attributes = [
    //     'delayed' => false,
    // ];  อันนี้ไว้สำหรับถ้าเราต้องกำหนดค่าเริ่มต้นใหักับตัวแปร ให้ใช้แบบนี้  

// ? Retrieving Models
        // $flights = Flight::all();//การ Select * from table ที่ถูกระบุว่าที่ model


        // ? Adding Additional Constraints
        // $flights = Flight::where('id', 1) // การตรวจสอบเงื่อนไข
        //        ->orderBy('name', 'desc') //การเรียง
        //        ->take(10) // การ Limits
        //        ->get();

        // $flights = Flight::where('id', 1) // การตรวจสอบเงื่อนไข
        //         ->orderBy('name', 'desc') //การเรียง
        //        ->take(10) // การ Limits
        //        ->value('name'); // มันจะส่งค่าตัวที่ระบุไว้ name กลับ


        // ? Refreshing Models
        // $flight = Flight::where('number', '18')->first();

        // echo $flight->number;

        // $flight->number = 'FR 456';

        // echo $flight->number;

        // $flight->refresh(); //มันคืนการย้อนค่ากลับไป 18 เหมือนเดิม

        // echo $flight->number;

        //echo $freshFlight;

            // foreach ($flights as $flight) {
            //   //  echo $flight->name;
            // }
        // ?  Collections
        // ในการดึงข้อมูลของ Eloquent methods จะใช้ all และ get เพื่อดึงหลายๆ ข้อมูล

        // ? Chunking Results
        // ถ้าในกรณีที่เราต้องทำการดึงข้อมูลประมาณมาก ๆ ให้ใช้ Chunking
        // Flight::chunk(200, function ($flights) {
        //     foreach ($flights as $flight) {
        //         echo $flight->name;
        //     }
        // }); ค่า 200 คือ จำนวนที่ต้องการ ดึงข้อมูลต่อ การ Chunk

         <!-- ? Advanced Subqueries -->
        // การใช้ Subquery
        // return Destination::addSelect(['last_flight' => Flight::select('name') // ให้เพิ่มการเลือก คอลัมน์ last_flight ไปดึงข้อมูลจาก คอลัมน์ Name มาใส่
        // ->whereColumn('destination_id', 'destinations.id') // โดยเงื่อนไข destination_id = destinations.id
        // ->orderBy('arrived_at', 'desc')
        // ->limit(1) //ดึงมา 1 คน
        // ])->get();

        // Retrieving Single Models / Aggregates คือการดึงข้อมูลแค่ แถว เดียว


         <!-- ? Retrieving Single Models / Aggregates -->
            // Retrieve a model by its primary key...
           // $flight = App\Flight::find(1); ดึง Primary key เท่ากับ 1
           //$flights = App\Flight::find([1, 2, 3]); ดึงแบบ อาเรย์

            // Retrieve the first model matching the query constraints...
           // $flight = App\Flight::where('active', 1)->first(); ดึง active = 1 แต่เอาแค่ตัวแรก

            // Shorthand for retrieving the first model matching the query constraints...
            //$flight = App\Flight::firstWhere('active', 1); ดึง active = 1 แต่ firstwhere คือตัวแรกของเงื่อนไข


            // $model = Flight::where('number', '>', 100)->firstOr(function () { // ,มันจะเช็คว่าเงื่อนไขเป็นจริงมั้ย ถ้าไม่เป็นจริงจะทำงานใน Funciton
            //     echo 555;
            // });


         <!-- ? Not Found Exceptions -->
            // $model = Flight::findOrFail(6); //ถ้าหาเจอจะแสดงปกติ ถ้าหาไม่เจอจะแสดง 404

        <!-- ? Retrieving Aggregates -->
            // $count = App\Flight::where('active', 1)->count(); // นับจำนวน

            // $max = App\Flight::where('active', 1)->max('price'); // หาค่าสูงสุดอ


         <!-- ? Inserting -->
            // $flight = new Flight; สร้างตัวแปร flight มาเท่ากับ Class Flight

            // $flight->name = $request->name; รับค่ามาเก็บ

            // $flight->save(); บันทึกลงฐานข้อมูล created_at and updated_at จะถูกเก็บลงไปด้วย

         <!-- ? Updating Models -->
            // $flight = App\Flight::find(1);

            // $flight->name = 'New Flight Name';

            // $flight->save(); ใช้สำหรับการ อัพเดท

        <!-- ? Mass update -->

        // App\Flight::where('active', 1)  // เมื่อ active = 1
        //   ->where('destination', 'San Diego') // เมื่อ ปลายทาง = San diego
        //   ->update(['delayed' => 1]); // จะให้ ใส่ค่า 1 ที่ คอลัมน์ Delay

       <!-- ? Examining Attribute Changes การตรวจสอบเมื่อมีการเปลี่ยนแปลง -->

        // isDirty มันจะเช็คว่า ตัวแปรนั้น มีการเปลี่ยนแปลงค่าหรือมั้ยนับตั้งแต่มันโหลดมา
        // isClean จะตรงข้ามกับ isDirty หรือหมายความว่ามันยังไม่มีการเปลี่ยนแปลงใด   2 function นี้จะ return ture or false
        // wasChanged มันนับระหว่างก่อน save() และหลัง save ว่ามีการเปลี่ยนแปลงหรือมั้ย ให้ค่า true or false only

         <!-- ? Mass Assignment -->

       // $flight = App\Flight::create(['name' => 'Flight 10']); // การที่เราจะใช้คำสั่ง Create เราต้องไปกำหนด
       // ที่ fillable or guarded attribute ก่อน มันถึงจะทำงานได้
        // และถ้าสมมุติเคยประกาศไปแล้วสามารถใช้ ได้เลย $flight->fill(['name' => 'Flight 22']);

        <!-- ? Guarding Attributes -->
       // เปรียนเทียบง่าย คือ fillable serves as a "white list" คืออนุญาต ส่วน Guading คือ Black list ไม่อนุญาติ
        //  protected $guarded = []; ถ้าประกาศแบบนี้คือไม่อนุญาตทั้งหมด

         <!-- ? Other Creation Methods -->

        // Retrieve flight by name, or create it if it doesn't exist...
        // $flight = App\Flight::firstOrCreate(['name' => 'Flight 10']); // ถ้า Flight 10 มันจะนำไปแสดง ถ้าไม่มีมันจะสร้าง ใหม่

         <!-- ? Deleting Models -->

        // $flight = App\Flight::find(1);

        // $flight->delete(); // สั่งลบแถวนั้น

        // App\Flight::destroy(1, 2, 3); สั่งทำลายทิ้ง

        //$deletedRows = App\Flight::where('active', 0)->delete(); // การลบแบบมีเงื่อนไข

        <!-- ? Soft Deleting -->

        // มันคือการไม่ได้ลบออกจาก DB เลยแต่มันจะสร้าง คอลัมน์ชื่อว่า deleted_at ขึ้นมา

        // class Flight extends Model
        // {
        //     use SoftDeletes;
        // }

        // Schema::table('flights', function (Blueprint $table) {
        //     $table->softDeletes();
        // });

         <!-- ? Replicating Models -->

        // มันคือการ สั่งซ้ำจาก การสร้างของ Shipping และมันยังสามารถเปลี่ยนแปลงค่าได้ด้วย

        // $shipping = Flight::create([
        //     'name' => 'shipping',
        //     'number' => '123',
        // ]);

        // $billing = $shipping->replicate()->fill([
        //     'name' => 'billing'
        // ]);

        // $billing->save();

        // ! Query Scopes ไม่เข้าใจ

        // ! Global Scopes ไม่เข้าใจ

        // ? Comparing Models

        // ใช้สำหรับการเปรียบเทียบ 2 Model ว่ามันเหมือนกันหรือไม่

        // if ($post->is($anotherPost)) {
        //     //
        // }

        // ? Events

        // ยังไม่ค่อยเข้าใจตัวอย่างไม่ชัด



<!-- ! Learn With Udemy -->

เวลาที่เราสร้าง ที่ Folder View สร้างสามารถสร้าง Folder ด้วยการพิม admin.index มันจะได้ไฟล์มาด้วย

เปรียบเทียบเรื่อง Relation ถ้าตารางไหนมี PrimaryKey จะใช้ HasOne or HasMany but เป็น Foreign Key จะต้องใช้ Belongto

<!--TODO php artisan make:controller --resource AdminUserController // มันจะสร้าง Function ให้เราเลย ดีมากๆ  -->

php artisan route help // คำสั่ง Help

php artisan route:list

npm install -g gulp ติดตั้ง gulp คืออะไรไม่รู้

emmet ให้กด tab คือการเลือก
 alt+. คือการปิด tag
clrt+w ปิด window
shif+alt+arrow or down คือ การ Copy โค้ดบรรทัดนั้น
alt+pageup or pagedown สลับตำแหน่ง
กด คลิกแล้ว กด crtl+d

{{$user->created_at->diffForHumans()}}  ไว้สำหรับแสดงเวลาแบบภาษามนุษย์

<td>{{$user->role ? $user->role->name : 'User has no role'}}</td> 
<td>{{$user->is_active == 1 ? 'Active' : 'Not Active' }}</td>


ckEditor ใช้สำหรับ แปลง text area ให้สามารถใส่ตัวหนา นู้นนี่นั้นได้

1. download จากเว็บ https://ckeditor.com/ckeditor-4/download/
2. copy file ckeditor ไปไว้ที่ public
3. เรียกใช้ {{-- CKEditor --}}
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('description', {});
</script>

4. เปลี่ยนชื่อ textarea เป็น description

 <!-- TODO การเปลี่ยน Format date time to ภาษามนุษย์ -->

use Carbon\Carbon;

    foreach ($post as $key => $posts) {
        $createdate = Carbon::parse($posts->created_at); // now date is a carbon instance
        $updatedate = Carbon::parse($posts->created_at); // now date is a carbon instance
        $posts->created_at = $createdate->isoFormat('LL');
        $posts->updated_at = $updatedate->diffForHumans();
    }

https://carbon.nesbot.com/docs/


การดึงชื่อ ต้นตำหรับของไฟล์
$request->file('upfile')->getClientOriginalName();

กฏข้อสำคัญเวลาจะส่งข้อมูลกับ Ajax ค่าห้าม Disable

ตรงปุ่ม Update ห้ามใช้ data-dismiss="modal"


<!-- ! คำสั่งในการทดสอบ Ajax -->


    <form id="change_name" class="d-block w-100">
        @csrf

        <div class="input-group mb-3">
            <input type="text" id="txt" name="comment" class="form-control rounded-pill"
                placeholder="comment..." aria-label="comment..."
                aria-describedby="button-comment" required>
        </div>
        <div class="input-group-append">
            <button type="submit" class="btn btn-success" id="button-comment">ยืนยัน</button>
        </div>

        {{-- Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br> --}}

    </form>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

   <script type="text/javascript">
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
    //   console.log('6666');
        $(document).ready(function(){
            $('#change_name').submit(function(e){

                e.preventDefault();
                var formData = new FormData(this);
                formData.append('user_id', '{{ $person->person_id }}');
                alert('555');
            });
        });
   </script>

==========================================================================================================


<!-- ? การแปลง JSON -->

  // Laravel gives you an array of the selected checkboxes
           // $flavours = $request->input('flavours');

            // Turn array into JSON string, so you can save it in a database column
        //    $jsonFlavours = json_encode($flavours);

            // Turn the JSON string back into an array
          //  $arrayFlavours = json_decode($jsonFlavours, true);


<!-- ?การติดตั้ง Datatable -->
composer require yajra/laravel-datatables-oracle
config.app

'providers' => [
    ...,
    Yajra\DataTables\DataTablesServiceProvider::class,
]

'aliases' => [
    ...,
    'DataTables' => Yajra\DataTables\Facades\DataTables::class,
]

php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"

Debugging Mode
To enable debugging mode, just set APP_DEBUG=true and the package will include the queries and inputs used when processing the table.

<!-- ! IMPORTANT: Please make sure that APP_DEBUG is set to false when your app is on production. -->


<!-- ? ในกรณีที่ Port MySQL เปิดไม่ขึ้นใน XAMMP -->

C:\xampp\mysql\backup ให้ Copy ทั้งหมดไปทับที่ C:\xampp\mysql\data



<!-- !Laravel Relation ยังไม่เข้าใจ -->

       $user = User::with('classroom.classroomtype')->get();

        $test = Classroom::with('classroomdivision.classroomdivisionuser')->get();
        // $comments = Classroom::find($id)->classroomdivision;


        foreach ($user as $key => $value) {
            foreach ($value->classroom as $key => $values) {
              //dd( $values->classroomtype->clst_name);
            }
        }



        foreach ($test as $key => $value) {


        //  echo $value->classroomdivision->div_name;
           dd($value->classroomdivision);
            foreach ($value->classroomdivision as $key => $values) {

                echo $values->div_name;
                echo $values->classroomdivisionuser->div_usr_total_point;

                dd($values);
            //  dd( $values->classroomdivisionuser->div_usr_total_point);
            }
        }


        // // ! กำลังทำ
        // $books = Classroom::with('classroomuser')->get();

        // foreach ($books as $book) {

        //     foreach ($book->classroomuser as $key => $value) {
        //         # code...
        //         echo $value->user_id."<br>";
        //     }

        //     // echo $book->classroomuser->user_id;
        // }

        // foreach ($comments as $key => $tables) {
        //     # code...


        // echo $tables->div_id;
        //     // dd($tables);
        // }

<!-- !Laravel Relation ยังไม่เข้าใจ -->


<!-- TODO การสร้าง Dummy Record -->

Step 3: Create Dummy Records

In this step, we will create some dummy users using tinker factory. so let's create dummy records using bellow command:

php artisan tinker

factory(App\User::class, 200)->create();
php artisan make:factory PostFactory --model=Post


<!-- !Bug owl carousel  -->

Actual fix for owl.carousel.min.js
Original:
(Math.abs(d.x)>3||(new Date).getTime()-this._drag.time>300)
Bug fix:
((Math.abs(d.x)>3||(new Date).getTime()-this._drag.time>300)&&e.Type==="mouseup")


<!-- ! ข้อความระวัง เวลาส่ง From ไม่สามารถใช้ tag a ได้เด็ดขาด -->
<form id="change_name" class="form-horizontal" role="form">
$('form#change_name').submit(function(e){

ต้องเรียกแบบนี้เท่านั้นไม่อย่างนั้นไม่ทำงาน







<!-- ! โค้ดสำหรับการส่ง Ajax แบบ Post โดยที่ไม่ต้อง Send Form  -->

@extends('layouts.master')

@section('nav')

@stop

@section('content')
    <!------------------------- Content ------------------------->

        {{-- <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt=""> --}}
        <div class="row">
            <form id="change_name" class="form-horizontal" role="form">
                @csrf
                Name: <input type="text" name="name"><br>
                E-mail: <input type="text" name="email"><br>
                <button type="submit" role="button" class="btn btn-success confrimLike">ยืนยัน</button>
            </form>

            <input type="text" name="species" id="species" value="555555">
            <input type="checkbox" name="ocheck" id="ocheck" value="1"checked>{{csrf_field()}}
            <a href="#" id="postjq">postjq</a>

        </div>

@stop


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $(function () {
        $("#postjq").click(function (event)
        {
            event.preventDefault();
            var $post = {};
            $post.species = $('#species').val();
            $post.ocheck = ($("#ocheck").prop("checked") == true ? '1' : '0');
            $post._token = document.getElementsByName("_token")[0].value
            $.ajax({
                url: '{{ route('pairing.edit') }}',
                type: 'POST',
                data: $post,
                cache: false,
                success: function (data) {
                    alert(data._token);

                    console.log(data);
                    return data;

                },
                error: function () {
                    alert('error handing here');
                }
            });
        });
    });

    </script>
<!-- ! โค้ดสำหรับการส่ง Ajax แบบ Post โดยที่ไม่ต้อง Send Form  -->


<!-- Learn Vue.Js  -->

php artisan make:model Message -a
มันจะสร้าง model migration seeder controller ให้หมดเลย

# การสร้าง Schema แบบมี comment
$table->unsignedBigInteger('from')->comment('Own Id'); //Own Id

# การ Clear Terminal  พิม cls

protected $guarded = []; ยังไม่รู้ประกาศไว้ทำไร

npm run watch ไว้สำหรับเราสร้างไปแก้ไขที่ resources->js แล้วมันจะ gen ให้เลย

chat widget html codepen ไว้สำหรับหา Template 

เอาไฟล์ css ไปแปะไว้ที่ app.scss

สร้างไฟล์ ที่ resources->js->component 
MainApp.vue

# มันสร้าง User ให้เอง 10
php artisan tinker
factory(App\User::class,10)->create();

# การติดตั้ง VUEX 
npm install vuex --save

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


function 
latest / oldest
มันจะเรียง คอลัมน์ created at

chrome สามารถเพิ่ม extension ไว้ดูไฟล์ json ได้
JSONView


# เอาไว้สำหรับการสร้าง ข้อมูลขึ้นมาเอง แต่เราสามารถกำหนดมันได้ที่ไฟล์ Factory
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avatar' => 'https://via.placeholder.com/150',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Message::class, function (Faker $faker) {
    do {
        $from = rand(1, 30);
        $to = rand(1, 30);
        $is_read = rand(0, 1);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
        'is_read' => $is_read
    ];
});

php artisan tinker
factory(App\User::class, 30)->create()
คำสั่งสร้าง ข้อมูลปลอม

# TODO การเซ็ต Debug PHP

เปิด http://localhost/dashboard/phpinfo.php
ให้กด ctrl+a  แล้ว copy ไว้
เอาที่ copy ไปวางไว้ที่ลิ้งค์นี้  https://xdebug.org/wizard

Download php_xdebug-2.9.4-7.2-vc15-x86_64.dll
Move the downloaded file to C:\xampp\php\ext
Edit C:\xampp\php\php.ini and add the line

[curl]
; A default value for the CURLOPT_CAINFO option. This is required to be an
; absolute path.
curl.cainfo="C:\xampp\apache\bin\curl-ca-bundle.crt"

[XDebug]
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
zend_extension = C:\xampp\php\ext\php_xdebug-2.9.4-7.2-vc15-x86_64.dl

ส่วนสุดท้ายติดต้ัง php debug ด้วย


<!-- ! เริ่มเรียน Vue Js  -->

ไว้สำหรับหัดเขียน https://jsfiddle.net/boilerplate/vue

<script src="js/app.js" charset="utf-8"></script>
การไปเรียกใช้ component ของ Vue

<div id="app">
    <example-component></example-component>
</div>

เรียกผ่าน id ที่ชื่อว่า app และไปใช้ example-component

และทำให้การ ใช้ npm run watch ตลอดเวลามันจะได้อัพเดทให้ด้วย
ในกรณีที่ใช้ ไม่ได้ให้ใช้ npm install --global cross-env
และไปที่ package.json ไปที่ dependencies ลบ cross ตัวเดิมออก

mounted แปลว่าถ้ามีการเรียกใช้ component นี้ จะเขียน log ออกมา จะทำงานตอนแรกต้น
mounted() {
    console.log('Component mounted.')
}

เพิ่มโค้ดนี้เพื่อเรียก bootstrap ที่ไฟล์ welcome
<link rel="stylesheet" href="/css/app.css">

protected $fillable=['name','city'];
การชี้ตำแหน่งโมเดล เพิ่มไว้จัดการฐานข้อมูล

ตัวนี้ไว้สำหรับการดึงข้อมูลไปแสดงเฉยๆ
php artisan make:controller UserController --resource

ให้สร้าง Folder ชื่อ Api ก่อน ทุกอย่างจะทำผ่าน Api
php artisan make:controller Api\UserController --resource

ใช้ axios ดึงข้อมูลจาก api ที่เป็น json


ไว้สำหรับไปดู json ใน api ที่เราสร้าง ผ่าน route
Route::resource('user', 'UserController');

http://127.0.0.1:8000/api/user

    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

methods ไว้สร้าง function ต่าง ๆ 

    mounted(){
        console.log("ok");
        this.getUserData();
    },

    methods:{
        getUserData(){
            //console.log('ดึงข้อมูล');


        }
    }


การจะดึงข้อมูลจาก API ให้ใช้ axios แต่วิธีการเรียกใช้ให้ไปที่ app.js
และเพิ่ม
window.axios= require('axios');


# คือสร้างให้ axios ไปดึงข้อมูลแบบ get จาก api/users แล้วถ้าสำเร็จต้อง ตอบสนองกลับเป็น response ที่ส่งมา
axios.get('api/user').then(respone=>{
            console.log(response);
        });





    methods:{
        getUserData(){
            axios.get('api/user').then(response=>{
            this.users= response.data;
            <!-- TODO ดึงข้อมูลจาก function data ไปเก็บที่ users -->
            console.log(response.data);
            });
        }
    },
    data(){
        return{
            users:[],
             <!-- TODO การสร้างตัวแปรชื่อ users -->
            usersfgdgdf:{
            <!-- TODO ตรงนี้สร้างโครงสร้าง json จะตั้งชื่อไรก็ได้ -->
                id:0,
                name:'',
                city:''
            }
        }
    }


    ขั้นตอน ลูป data

      <tr v-for="user in users" :key="user.id" >
         <td>{{user.id}}</td>
         <td>{{user.name}}</td>
         <td>{{user.city}}</td>
         <td><a href="#" class="btn btn-primary">Edit</a></td>
         <td><a href="#" class="btn btn-danger">Delete</a></td>
     </tr>

Data blinding คือการเอาข้อมูลไปผูกกับตัวฟอร์ม

v-model="name"
v-model="city"

การตั้งชื่อ inputtext
เหมือนกับ name="name" name="city"

เมื่อเรากดคลิกจะไปเรียกใช้ funciton อะไร
 <button class="btn btn-primary" v-on:click="addNewUser()">เพิ่มข้อมูล</button>


มันคือกสร้าง เรียกใช้ method .post ไปที่ api/user และ
set key name = this.name
และ key city = this.city
  methods:{
        addNewUser(){
            // console.log(this.name);
            // console.log(this.city);

            axios.post('api/user', {
                namd:this.name,
                city:this.city
            })
        }
    }

# เรียน Vue Laravel

 npm install admin-lte@v3.0.0-alpha.2 --save

https://adminlte.io/themes/dev/AdminLTE/starter.html

<script src="/js/app.js"></script>

<link rel="stylesheet" href="/css/app.css">


bootstrap.js
require('admin-lte');


app.scss
@import '~admin-lte/dist/css/adminlte.css';


flaticon

@fa-font-path:   "../font";


https://fontawesome.com/how-to-use/on-the-web/using-with/sass
npm install @fortawesome/fontawesome-free


ติดตั้ง git ก่อน
สร้าง repository git

git remote add origin https://github.com/anutchai/larastart.git

git push -u origin master

# ติดตั้งตัว router ของ vue เป็นขั้นตอนการทำ Router

https://router.vuejs.org/

npm install vue-router

<div class="content">
<div class="container-fluid">
  <router-view></router-view>
</div><!-- /.container-fluid -->
</div>

import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default }
]

const router = new VueRouter({
    routes // short for `routes: routes`
  })


const app = new Vue({
    el: '#app',
    router
});

<div class="wrapper" id="app">

<router-link to="/dashboard" class="nav-link">
</router-link>


php artisan route:list

# ติดตั้ง npm i axios vform
https://github.com/cretueusebiu/vform

# การสร้าง API
php artisan make:controller API/UserController --api

Route::apiResources(['user' => 'API\UserController']);

php artisan route:list
ไว้เช็คเส้นทาง


# วิธีการเช็คว่าเขียนแล้วมันส่งไปที่ API จริงหรือไม่
กด f12 network xhr

ส่วนฝั่ง controller ใส่บรรทัดเข้าไป
//return  ['message' => 'I have your data'];

return $request->all();

# การสร้าง filter

https://vuejs.org/v2/guide/filters.html

Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

{{user.type | upText}}

# ติดตั้ง Moment.Js

npm install moment --save  

import moment from 'moment';

# ติดตั้ง Progressbar

http://hilongjw.github.io/vue-progressbar/

npm install vue-progressbar

import VueProgressBar from 'vue-progressbar'

# ติดตั้ง Sweetalert2

npm install sweetalert2

import Swal from 'sweetalert2';
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  window.toast = toast;
toast.fire({
  icon: 'success',
  title: 'User in successfully'
})
this.$Progress.finish();

# Send HTTP Request Every 3 Seconds 

created(){
   this.loadUser();
   setInterval(() => this.loadUser(), 3000);

}

# Send HTTP Request

window.Fire = new Vue();

created(){
   this.loadUser();
   Fire.$on('AfterCreate',() =>{
       this.loadUser();
   });
   // setInterval(() => this.loadUser(), 3000);
}

createUser(){
    this.$Progress.start();

    this.form.post('api/user')
    .then(()=>{
        Fire.$emit('AfterCreate');
        $('#addNew').modal('hide');
        toast.fire({
            icon: 'success',
            title: 'User in successfully'
        })
        this.$Progress.finish();
    })
    .catch(()=>{

    })

}

# การทำ Delete with Ajax

deleteUser(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            // Send request to the server
            if (result.value) {
                this.$Progress.start();
                this.form.delete('api/user/'+id).then(()=>{

                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');

                }).catch(()=>{
                    Swal("Failed!", "There was something wronge.","warning");
                })

            }
    })
},

# การสร้าง Modal อันเดียวแต่ใช้ร่วมกันระหว่าง Create และ Update


https://github.com/cretueusebiu/vform

editModal(user){
    this.form.reset();
    $('#addNew').modal('show');
    this.form.fill(user);
},
newModal(){
    this.form.reset();
    $('#addNew').modal('show');
},

# การสร้างให้ มันสลับโหมดการทำงาน

data(){
    return {
        editmode: false,
        users: {},
        form: new Form({
            id : '',
            name : '',
            email : '',
            password : '',
            type : '',
            bio : '',
            photo : ''
        })
    }
},

 <form @submit.prevent="editmode ? updateUser() : createUser()">


# การตรวจสอบความปลอดภัยโดยใช้ 

postman api

https://www.postman.com/downloads/

ไว้สำหรับทดสอบ api

ต้องติดตั้ง composer

composer require laravel/passport

php artisan migrate

php artisan passport:install

ไฟล์ model
use Laravel\Passport\HasApiTokens;
use Notifiable,HasApiTokens;

ไฟล์ authserviceProvider

use Laravel\Passport\Passport;
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        //
    }

ไฟล์ config auth
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
            'hash' => false,
        ],

php artisan vendor:publish --tag=passport-migrations


ใส่  app.js

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


สร้าง component Developer ขึ้นมา

เอาไปใส่ใน 
app ->kernel

\Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,


เอาไปใส่ที่ api/user
    public function __construct()
    {
        $this->middleware('auth:api');
    }


# การทำไฟล์ Upload

updateProfile(e){
                //console.log('uploading');
                let file = e.target.files[0];
                console.log(file);
                let reader = new FileReader();

                reader.onloadend = (file)=>{
                    //console.log('RESULT', reader.result)
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }

composer require intervention/image


 if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }


# การดึงรูปมาใช้

:src="getProfilePhoto()"


getProfilePhoto(){
    let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
    return photo;
},

# Update Laravel Version

composer update


# การทำงาน ACL Check Permission

AuthServiceProvider

Gate::define('isAdmin',function($user){
    return $user->type === 'admin';
});

Gate::define('isAuthor',function($user){
    return $user->type === 'author';
});

Gate::define('isUser',function($user){
    return $user->type === 'user';
});


# การเช็คสิทธิ์ใน ทำงาน

$this->authorize('isAdmin');

    public function destroy($id)
    {
        $this->authorize('isAdmin');

        // ไว้ Debug ว่ามันหาเจอมั้ย
        $user = User::findOrFail($id);

        $user->delete();

        // ไว้ Debug ส่งค่ากลับ
        return ['message' => 'User Deleted'];

    }


# การใช้สิทธิ์ด้าน Front-end

สร้างไฟล์ gate

export default class Gate{

    constructor(user){
        this.user = user;
    }


    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'user';
    }
    isAdminOrAuthor(){
        if(this.user.type === 'admin' || this.user.type === 'author'){
            return true;
        }

    }
    isAuthorOrUser(){
        if(this.user.type === 'user' || this.user.type === 'author'){
            return true;
        }

    }


app.js 
}
import Gate from "./gate";
Vue.prototype.$gate = new Gate(window.user);


master.blade.php
@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

เช็คที่ไฟล์ user.vue
v-if="$gate.isAdminOrAuthor()


if(this.$gate.isAdminOrAuthor()){
    axios.get("api/user").then(({ data }) => (this.users = data));
}


loadUser(){

    if(this.$gate.isAdminOrAuthor()){
        console.log('admin');
        axios.get("api/user").then(({ data }) => (this.users = data.data));
    }else{
        console.log('user');
    }

},


# Design 404 Page for Front-End If User Doesn't Have Access

ไว้หา ไฟล์ สวยๆ
https://undraw.co/illustrations

แล้วก็ดึง Code SVG มาใส่ได้เลย

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

<div class="row mt-5" v-if="!$gate.isAdminOrAuthor()">
    <not-found></not-found>
</div>


# การ Set Gate

use Illuminate\Support\Facades\Gate;

if (Gate::allows('isAdmin') || Gate::allows('isAuthor')) {
    return User::latest()->paginate(10);
}


if(this.$gate.isAdminOrAuthor()){
    console.log('admin');
    axios.get("api/user").then(({ data }) => (this.users = data.data));
}

# การทำ Vue Table

https://www.vuetable.com/

https://github.com/ratiw/vuetable-2

https://github.com/spatie/vue-table-component

https://github.com/gilbitron/laravel-vue-pagination

npm install laravel-vue-pagination

Vue.component('pagination', require('laravel-vue-pagination'));

<div class="card-footer">
    <pagination :data="users" @pagination-change-page="getResults"></pagination>
</div>


getResults(page = 1) {
            axios.get('api/user?page=' + page)
                .then(response => {
                    this.users = response.data;
                });
    },

# การทำงาน Any Route Not Found

{ path: '*', component: require('./components/NotFound.vue').default }

# การทำปุ่ม Search

const app = new Vue({
    el: '#app',
    router, // การเพิ่ม Router
    data:{
        serach: ''

    }
});


# การทำ PDF ง่ายๆ

printme() {
    window.print();
}

# shortcut
alt+arrow down 
คือจัดตำแหน่ง
clrt+shift+k 
delete line

# Import & Export Excel

https://www.webslesson.info/2019/06/how-to-import-export-csv-file-data-in-laravel-58.html

composer require maatwebsite/excel

php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"

use Maatwebsite\Excel\Facades\Excel;
<!-- ! ข้อควรระวัง .csv ไม่รอบรับภาษาไทยแนะนำให้ใช้เป็น ไฟล์ .xlxs -->

ไฟล์ Template เก็บที่ public->excel->Simpla_Exam.xlxs

# Laravel Vue GrahpQL

https://graphql.org/
https://lighthouse-php.com/
https://apollo.vuejs.org/
https://developer.github.com/v4/explorer/
https://insomnia.rest/download/#windows

get https://api.github.com/users/drehimself/followers

https://github.com/nuwave/lighthouse-tutorial

git clone https://github.com/nuwave/lighthouse-tutorial.git

open project ที่ Clone มา

composer update

composer install

สร้าง DB ใน phpmyadmin
lighthouse-tutorial

factory ('App\User', 10)->create()

ตัวอย่างคำสั่ง

# การอัพไฟล์ขึ้น Github
git init
git add .
git commit -m "first commit"
git config --global user.email "cg_bsod@hotmail.com"
git config --global user.name "anutchai"
git commit -m "first commit"
git remote add origin https://github.com/anutchaimm/firstproject.git
git push -u origin master
git push --force origin master

ถ้าเจอ Error

Github remote permission denied
ให้ไปที่
Windows Credential Managers.

และเซ็ต Username Password ใหม่ ที่ Github
