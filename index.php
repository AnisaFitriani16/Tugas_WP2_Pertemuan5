<?php

class Book {
    private $title;
    private $author;
    private $year;
    private $status; // 0: available, 1: borrowed

    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = 0; // By default, book is available
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getYear() {
        return $this->year;
    }

    public function getStatus() {
        return $this->status == 0 ? "Available" : "Borrowed";
    }

    public function borrow() {
        if ($this->status == 0) {
            $this->status = 1;
            echo "Book '{$this->title}' has been borrowed.\n";
        } else {
            echo "Book '{$this->title}' is already borrowed.\n";
        }
    }

    public function returnBook() {
        if ($this->status == 1) {
            $this->status = 0;
            echo "Book '{$this->title}' has been returned.\n";
        } else {
            echo "Book '{$this->title}' is not borrowed.\n";
        }
    }
}

class Library {
    private static $books = [];

    public static function addBook(Book $book) {
        self::$books[] = $book;
        echo "Book '{$book->getTitle()}' has been added to the library.\n";
    }

    public static function borrowBook($title) {
        $found = false;
        foreach (self::$books as $book) {
            if ($book->getTitle() == $title) {
                $book->borrow();
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "Book '{$title}' is not available in the library.\n";
        }
    }

    public static function returnBook($title) {
        $found = false;
        foreach (self::$books as $book) {
            if ($book->getTitle() == $title) {
                $book->returnBook();
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "Book '{$title}' is not available in the library.\n";
        }
    }

    public static function listBooks() {
        if (count(self::$books) == 0) {
            echo "No books available in the library.\n";
        } else {
            echo "Available books in the library:\n";
            foreach (self::$books as $book) {
                echo "- {$book->getTitle()} by {$book->getAuthor()} ({$book->getYear()}), Status: {$book->getStatus()}\n";
            }
        }
    }
}

// Test the system
$book1 = new Book("Laskar Pelangi", "Andrea Hirata", 2005);
$book2 = new Book("5cm", "Donny Dhirgantoro", 2005);
$book3 = new Book("Ayat-ayat Cinta", "Habiburrahman El Shirazy", 2004);
$book4 = new Book("Harry Potter and the Philosopher's Stone", "J.K. Rowling", 1997);
$book5 = new Book("Pride and Prejudice", "Jane Austen", 1813);

Library::addBook($book1);
Library::addBook($book2);
Library::addBook($book3);
Library::addBook($book4);
Library::addBook($book5);

echo "\n------------------------------------------------------------------------------\n";
echo "------------------------------- PEMINJAMAN BUKU -------------------------------\n";

Library::borrowBook("Laskar Pelangi"); // Borrowing the book
Library::borrowBook("5cm"); // Borrowing the book
Library::borrowBook("Ayat-ayat Cinta"); // Borrowing the book

echo "\n------------------------------ BUKU YANG TERSEDIA ------------------------------\n";
Library::listBooks(); // Listing available books

echo "\n------------------------------------------------------------------------------\n";
echo "---------------------------- PENGEMBALIAN BUKU -------------------------------\n";

Library::returnBook("Laskar Pelangi"); // Returning the book

echo "\n------------------------------ BUKU YANG TERSEDIA ------------------------------\n";
Library::listBooks(); // Listing available books

?>
