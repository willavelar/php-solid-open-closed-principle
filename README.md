## Open/closed principle

This principle says that you should be able to extend a class's behavior without modifying it, the class is open to expansion and closed to change.

Whenever we need to create a new feature, we must create a new class that implements that feature.

We will create an example. Let's imagine the situation where we have to create a small class to record application logs.

```php
<?php
class Logger
{
    public function writeTxt($message)
    {
        //logic
    }
}
```

In this example, our class creates .txt files to store log messages. Now, if we wanted to create one for creating .csv files, we would need to modify the class to something like this:

```php
<?php
class Logger
{
    public function writeTxt($message)
    {
        //logic
    }

    public function writeCsv($message)
    {
        //logic
    }
}
```

It was necessary to change the Logger class, something that violates the open/closed principle. The class must be closed for change.

Let's refactor our code.

```php
<?php
class Logger
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function write($message)
    {
        $this->writer->write($message);
    }
}
```

```php
<?php
interface Writer
{
    public function write($message);
}
```
```php
<?php
class Txt extends Logger implements Writer 
{
    public function write($message)
    {
        //logic
    }
}
```
```php
<?php
class Csv extends Logger implements Writer 
{
    public function write($message)
    {
        //logic
    }
}
```

Now yes. We've implemented the same features we had before, but now, to implement a new feature, like writing in .doc, for example, just create a new Doc class that implements the Writer interface and that's it, we don't change anything in the Logger class.