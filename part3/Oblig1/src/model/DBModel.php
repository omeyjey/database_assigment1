<?php
include_once("IModel.php");
include_once("Book.php");

/** The Model is the class holding data about a collection of books.
 * @author Rune Hjelsvold
 * @see http://php-html.net/tutorials/model-view-controller-in-php/ The tutorial code used as basis.
 */
class DBModel implements IModel {

  /**
    * The PDO object for interfacing the database
    *
    */
  protected $db = null;

  /**
  * @throws PDOException
  */
  public function __construct($db = null) {
    if ($db) {
      $this->db = $db;
    }
    else {
      $this->db = new PDO('mysql:host=127.0.0.1;dbname=oblig1', 'root', '');
    }
  }

  /** Function returning the complete list of books in the collection. Books are
   * returned in order of id.
   * @return Book[] An array of book objects indexed and ordered by their id.
 * @throws PDOException
   */
  public function getBookList() {
    $bookList = [];
    $smth = $this->db->prepare('SELECT * FROM book');
    $smth->execute();
    while($row = $smth->fetchObject()) {
      $bookList[] = new Book($row->title, $row->author, $row->description, $row->id);
    }
    return $bookList;
  }

  /** Function retrieving information about a given book in the collection.
   * @param integer $id the id of the book to be retrieved
   * @return Book|null The book matching the $id exists in the collection; null otherwise.
 * @throws PDOException
   */
  public function getBookById($id) {
    $smth = $this->db->prepare('SELECT * FROM book WHERE id=?');
    $smth->execute( [$id] );
    $book = $smth->fetchObject();
    if ($book) {
      return new Book($book->title, $book->author, $book->description, $book->id);
    } else {
      return null;
    }
  }

  /** Adds a new book to the collection.
   * @param $book Book The book to be added - the id of the book will be set after successful insertion.
 * @throws PDOException
   */
  public function addBook($book) {
    $smth = $this->db->prepare('INSERT INTO book (title, author, description)VALUES(:title, :author, :description)');
    $smth->execute([
        ':title' => $book->title,
        ':author' => $book->author,
        ':description' => $book->description
    ]);

    $book->id = $this->db->lastInsertId();
  }

  /** Modifies data related to a book in the collection.
   * @param $book Book The book data to be kept.
   * @todo Implement function using PDO and a real database.
   */
  public function modifyBook($book) {
    $smth = $this->db->prepare('UPDATE book SET title=:title, author=:author, description=:description WHERE id=:id');
    $smth->execute([
      ':title' => $book->title,
      ':author' => $book->author,
      ':description' => $book->description,
      ':id' => $book->id
    ]);
  }

  /** Deletes data related to a book from the collection.
   * @param $id integer The id of the book that should be removed from the collection.
   */
  public function deleteBook($id) {
    $smth = $this->db->prepare('DELETE FROM book WHERE id=?');
    $smth->execute([$id]);
  }
}

?>
