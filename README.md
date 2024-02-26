Laravel Migration Mapper Package
=====
Automatically generate you migration files from your models 

## Why
One of the most important and critical part of laravel application is the migration files.
Each time you need to add s single column to your table, you need to go to the console, create your migration file,
add your migration commands and finally run the migrations.

This package will hide this over head from you, you only need to define the blueprint of you model 
and we will handle everything automatically.

## Installation

Install using composer:

```bash
composer require aldeebhasan/migration-mapper
```

After installation run the following code to publish the config:

```bash
php artisan vendor:publish --tag=migration-mapper-config
```

## Basic Usage
Let's suppose that you have a model named as `Product` with three parameters `[id,name,description,category_id,visisble]` as Follow:
```php
#[Table(
    name: 'x_models', // optional
    columns: [
        new Id(),
        new String_('name', length:255, default: "admin"),
        new Text('description', length:255, default: "admin"),
        new BigInteger('category_id', nullable: true, index: true, unsigned: true),
        new Enum('visible', ['off', 'on'], default: 'off', comment: 'status of the product'),
    ]
)]
class XModel extends Model
{
    protected $fillable = [
        'name', 'description', 'category_id'
    ]; 
}
```
Each time you want to generate the migration files, you simply need to call:
```bash
php artisan mapper:generate
```

The result of the above command will be: 
```
database
    migrations
        2024_02_19_1708369156_create_x_models_table_m.php
```

***Note that the `name` parameter of table is optional. If it doesn't provided we will detect the table name from the model*** 


---
If you want to discard all previous changes and migratin and start again from scratch, 
you can use the following command:
```bash
php artisan mapper:regenerate
```
By calling it we will delete all the migration files, all our logs and start again from zero.

---
At any point of time, if you want to rollback the last generation process, you can use the following command:
```bash
php artisan mapper:rollback
```

### Supported Column Type
* Boolean()
* Date()
* DateTme()
* Time()
* TinyInteger()
* SmallInteger()
* Integer()
* MediumInteger()
* BigInteger()
* Decimal()
* Double()
* Float_()
* Enum()
* Id()
* String_()
* TinyText()
* SmallText()
* MediumText()
* Text()
* LongText()

Each of these types has a specific parameters that represent the operation the can handle.

### Relations:
This package can also handle the relation between models.
The relation that we may interest in is `Many To One` and `Many To Many` relations, since they have direct effect on the model itself

lets consider that we have the following model:
```php
#[Table(
    columns: [
        new Id(),
        new String_('name', length:255, default: "admin"),
        new BigInteger('category_id',unsigned: true,index: true),
    ]
)]
class Product extends Model
{
    protected $fillable = [
        'name','category_id'
    ]; 
    
    #[ManyToOne(related: Category::class)]
    public function category(): HasMany
    {
        return $this->belongsTo(Category::class, 'category_id')   
    }
    
    #[ManyToMany(related: Product::class, table: 'product_related', foreignKey: 'source_id', localKey: 'id', targetForeignKey: 'target_id', targetLocalKey: 'id')]
    public function related_products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_related', 'source_id', 'target_id');
    }
    
}
```
By calling `php artisan mapper:generate`,
the package will generate  two tables for you
and we will get the followings:
```
database
    migrations
        2024_02_19_1708369156_create_products_table_m.php
        2024_02_19_1708369157_create_product_related_table_m.php
```

***Please Note the other kind of relation has no effect over the model, so there is no idea of handling them.***

## License

Laravel Migration Mapper  package is licensed under [The MIT License (MIT)](LICENSE).

## Security contact information

To report a security vulnerability, contact directly to the developer contact email [Here](mailto:aldeeb.91@gmail.com).
