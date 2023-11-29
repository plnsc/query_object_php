# query_object_php

This is a simple implementation of Query Object Design Pattern in PHP.

Why? Years ago when I was first learning PHP, I wrote something similar to practice, based on the implementation present in [Pablo Dall’Oglio PHP book](https://novatec.com.br/livros/php-orientacao-objetos-4ed/). I decided to write it again, doing some improvements and writing some tests, just to play around a little bit.

Do you want to modify something? Feel free to do it and I would love to know what you did to it 👨🏻‍🎨.

**After cloning it**, run the following command to install dependencies:

```bash
make install
```

What that does? Calls a script to download, verify and install composer in the current directory, and then and calls `composer install` to initialize the vendor folder.

I might implement a query builder in JavaScript and Python after this as well.

## Examples

Some code examples for this package:

### Expressions

Exemplo 1:

```php
$filter = Filter::equals('some_column', 'some_value');
echo $filter->dump();
```

Output:

```sql
some_column = 'some_value'
```

Exemplo 2:

```php
$filter = Filter::is_not('some_column', null);
echo $filter->dump();
```

Output:

```sql
some_column IS NOT NULL
```

Exemplo 3:

```php
$criteria = new Criteria;
$criteria->add(Filter::like('some_column', '%something%'));
dump_example($criteria);
```

Output:

```sql
(some_column LIKE '%something%')
```

Exemplo 4:

```php
$criteria = new Criteria;
$criteria->add(Filter::in('some_number', [10, 11, 12, 13]));
$criteria->add(Filter::lt_equals('some_other_number', 70));
echo $criteria->dump();
```

Output:

```sql
(some_number IN (10,11,12,13) AND some_other_number <= 70)
```

Exemplo 5:

```php
$criteria1 = new Criteria;
$criteria1->add(Filter::not_like('some_column_1', '%something%'));
$criteria1->add(Filter::between('some_column_2', 0, 100), Dialect::OPERATOR_OR);

$criteria2 = new Criteria;
$criteria2->add(Filter::like('some_column_0', '%something%'));
$criteria2->add($criteria1, Dialect::OPERATOR_OR);

echo $criteria2->dump();
```

Output:

```sql
(some_column_0 LIKE '%something%' OR (some_column_1 NOT LIKE '%something%' OR some_column_2 BETWEEN 0 AND 100))
```

### Insert

Exemplo 6:

```php
$insert = new Insert;
$insert->set_entity('table_name');

$insert->add_row('id', 10);
$insert->add_row('name', 'somebody');
$insert->add_row('somedate', '1993-12-17');
$insert->add_row('some_number', 7000);

$insert->next_row();

$insert->add_row('id', 11);
$insert->add_row('name', 'somebody 2');
$insert->add_row('somedate', '1997-02-21');
$insert->add_row('some_number', 7001);

echo $insert->dump();
```

Output:

```sql
INSERT INTO table_name (id, name, somedate, some_number) VALUES (10, 'somebody', '1993-12-17', 7000), (11, 'somebody 2', '1997-02-21', 7001);
```

### Delete

Exemplo 7:

```php
$delete = new Delete;
$delete->set_entity('table_name');
$delete->set_expression(Filter::equals('some_table_id', 3));
echo $delete->dump();
```

Output:

```sql
DELETE FROM table_name WHERE some_table_id = 3;
```

### Update

Exemplo 8:

```php
$update = new Update;
$update->set_entity('table_name');
$update->add_row('name', 'some name');
$update->add_row('email', 'some@email.here');
$update->set_expression(Filter::equals('id', 3));
```

Output:

```sql
UPDATE table_name SET name = 'some name', email = 'some@email.here' WHERE id = 3;
```

### Select

Exemplo 9:

```php
$select = new Select;
$select->set_entity('table_name');

$criteria = new Criteria;
$criteria->add(Filter::like('name', 'some_name%'));
$criteria->order_by('id', -1);
$criteria->order_by('name');
$criteria->limit(10);
$criteria->offset(0);

$select->set_expression($criteria);
```

Output:

```sql
SELECT  FROM table_name WHERE (name LIKE 'some_name%') ORDER BY id DESC, name ASC LIMIT 10 OFFSET 0;
```
