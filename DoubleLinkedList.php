<?php

class Node {
    public $data;
    public $next;
    public $prev;
    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}

class DoubleLinkedList {
    public $head;
    public $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    // Add at the end
    public function append($data)
    {
        $newNode = new Node($data);

        if ($this->head == null) {
            $this->head = $newNode;
        } else {
            $this->tail->next = $newNode;
            $newNode->prev = $this->tail;
        }
        $this->tail = $newNode;
    }

    public function prepend($data)
    {
        $newNode = new Node($data);
        if ($this->head == null) {
            $this->tail = $newNode;
        } else {
            $this->head->prev = $newNode;
            $newNode->next = $this->head;
        }
        $this->head = $newNode;
    }


    public function traversForward()
    {
        $current = $this->head;
        $result = [];

        while ($current != null) {
            $result[] = $current->data;
            $current = $current->next;
        }

        return $result;
    }
    public function printForward()
    {
        echo "Forward: " . implode(" -> ", $this->traversForward()) . PHP_EOL;
    }
}

$list = new DoubleLinkedList();
$list->append(4);
$list->append(5);
$list->prepend(3);

$list->printForward();