<?php

include_once("Book.php");
include_once("IModel.php");
include_once('DBModel.php');

/** The Model is the class holding data about a collection of books.
 * @author Rune Hjelsvold
 * @see http://php-html.net/tutorials/model-view-controller-in-php/ The tutorial code used as basis.
 */
class Model implements IModel
{
	private $dbmodel;

	public function __construct() {
			$this->dbmodel = new DBModel();
	}

	/** Function returning the complete list of books in the collection. Books are
	 * returned in order of id.
	 * @return Book[] An array of book objects indexed and ordered by their id.
	 */
	public function getBookList() {
		return $this->dbmodel->getBookList();
	}

	/** Function retrieveing information about a given book in the collection.
	 * @param integer $id The id of the book to be retrieved.
	 * @return Book|null The book matching the $id exists in the collection; null otherwise.
	 * @todo Replace implementation using a real database.
	 */
	public function getBookById($id) {
		if(is_numeric($id)) {
			return $this->dbmodel->getBookById($id);
		}
		return null;
	}

	/** Adds a new book to the collection.
	 * @param $book Book The book to be added - the id of the book will be set after successful insertion.
	 * @todo Replace implementation using a real database.
	 */
	public function addBook($book) {
		return $this->dbmodel->addBook($book);
	}

	/** Modifies data related to a book in the collection.
	 * @param Book $book The book data to kept.
	 * @todo Replace implementation using a real database.
	 */
	public function modifyBook($book) {
		return $this->dbmodel->modifyBook($book);
	}

	/** Deletes data related to a book from the collection.
	 * @param integer $id The id of the book that should be removed from the collection.
	 * @todo Replace implementation using a real database.
	 */
	public function deleteBook($id) {
		return $this->dbmodel->deleteBook($id);
	}
}

?>
