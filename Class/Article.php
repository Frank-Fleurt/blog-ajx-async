<?php
class Article
{
  public string $title;
  public string $content;
  public string $author;
  private int $title_min_lenght = 1;
  private int $title_max_lenght = 30;
  private int $content_min_lenght = 1;
  private int $author_min_lenght = 1;
  private int $author_max_lenght = 20;

  public function __construct(string $p_title, string $p_content, string $p_author)
  {
    $this->title = $p_title;
    $this->content = $p_content;
    $this->author = $p_author;  
  }

  public function validate()
  {
    if (
      strlen($this->title) > $this->title_min_lenght &&
      strlen($this->title) < $this->title_max_lenght &&
      strlen($this->content) > $this->content_min_lenght &&
      strlen($this->author) > $this->author_min_lenght &&
      strlen($this->author) < $this->author_max_lenght
    ) {
      return true;
    };
  }
  public function toArray()
  {
    return [
      "title" => $this->title,
      "content" => $this->content,
      "author" => $this->author,
    ];
  }
}
