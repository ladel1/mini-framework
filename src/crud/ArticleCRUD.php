<?php 

    namespace App\Crud;

    use App\Model\Article;

    class ArticleCRUD extends CRUD{

        public function insert($article){
            $this->persist($article);
        }

        public function selectAll(){
            define("SELECT_ARTICLES","SELECT * FROM articles");
            $stmt = $this->db->prepare(SELECT_ARTICLES);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,Article::class);
        }

        public function selectByTitle($titre){
            define("SEARCH_ARTICLES","SELECT * FROM articles WHERE titre LIKE :title");
            $stmt = $this->db->prepare(SEARCH_ARTICLES);
            $stmt->bindValue(":title","%$titre%");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,Article::class);
        }        

        public function delete($id){
            define("DELETE_ARTICLE","DELETE FROM articles WHERE id = :id ");
            $stmt = $this->db->prepare(DELETE_ARTICLE);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            return $stmt->rowCount();
        }

    }