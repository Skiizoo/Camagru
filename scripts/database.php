<?php

    function selectFirst($db, $table, $where) {
        $request = 'SELECT * FROM ' . $table . ' WHERE 1 = 1';
        foreach ($where as $key => $value)
            $request .= ' AND ' . $key . ' = :' . $key;
        $statement = $db->prepare($request);
        foreach ($where as $key => $value)
            $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function selectAll($db, $table, $where = '') {
        $request = 'SELECT * FROM ' . $table . ' WHERE 1 = 1';
        if ($where) {
            foreach ($where as $key => $value)
                $request .= ' AND ' . $key . ' = :' . $key;
            $statement = $db->prepare($request);
            foreach ($where as $key => $value)
                $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
        } else
            $statement = $db->prepare($request);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getColumns($db, $table) {
        $statement = $db->prepare('SELECT column_name FROM information_schema.columns WHERE table_name = :table');
        $statement->bindValue(':table', $table);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    function insert($db, $table, $fields, $params) {
        $requestField = '';
        $requestValue = '';
        unset($params['id']);
        foreach ($params as $key => $value)
            if (in_array($key, $fields)) {
                $requestField .= '`' . $key . '`, ';
                $requestValue .= ':' . $key . ', ';
            }
        $statement = $db->prepare('INSERT INTO ' . $table . ' (' . rtrim($requestField, ', ') . ') VALUES (' . rtrim($requestValue, ', ') . ')');
        foreach ($params as $key => $value)
            if (in_array($key, $fields))
                $statement->bindValue(':' . $key, $value);
        $statement->execute();
        return $db->lastInsertId();
    }

    function update($db, $table, $fields, $params) {
        $requestField = '';
        foreach ($params as $key => $value)
             if (in_array($key, $fields))
                $requestField .= '`' . $key . '`= :' . $key . ', ';
        $statement = $db->prepare('UPDATE ' . $table . ' SET ' . rtrim($requestField, ', ') . ' WHERE id = :id');
        foreach ($params as $key => $value)
            if (in_array($key, $fields))
                $statement->bindValue(':' . $key, $value);
        $statement->bindValue(':id', $params['id']);
        $statement->execute();
        return true;
    }

    function delete($db, $table, $id) {
        $request = 'DELETE FROM ' . $table . ' WHERE id = :id';
        $statement = $db->prepare($request);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    function store($db, $table, $params) {
        $fields = getColumns($db, $table);
        if (!isset($params['id']))
            return insert($db, $table, $fields, $params);
        else
            return update($db, $table, $fields, $params);
    }
    