<?php

interface EntityInterface {

    public function getAll();

    public function delete();

    public function save();

    public function getById(int $id);

    public function deleteById(int $id);
}