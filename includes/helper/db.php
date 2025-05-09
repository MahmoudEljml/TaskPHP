<?php
/**
 * 
 * @param $table string
 * @param $data  array
 * @return array
 * 
 */
if (!function_exists('db_create')) {
    function db_create($table, array $data)
    {
        $sql = 'INSERT INTO ' . $table;
        $columns = "";
        $values = "";
        foreach ($data as $key => $value) {
            if ($key == "password") {
                $value = bcrypt($value);
            }
            $columns .= $key . ", ";
            $values .= " '" . $value . "' , ";
        }
        $columns = rtrim($columns, ", ");
        $values = rtrim($values, ", ");
        $sql .= " ( $columns ) VALUES ( $values ) ;";
        mysqli_query($GLOBALS["connection"], $sql);
        $id = mysqli_insert_id($GLOBALS['connection']);
        $first = mysqli_query($GLOBALS['connection'], "select * from $table where id=$id");
        $data = mysqli_fetch_assoc($first);
        $GLOBALS['query'] = $first;
        return $data;
    }
}


/**
 * 
 * @param $table string
 * @param $data  array
 * @param $id    int
 * @return bool
 * 
 */
if (!function_exists('db_update')) {
    function db_update(string $table, array $data, int $id)
    {
        $sql = 'UPDATE ' . $table . " SET ";
        $updates = "";
        foreach ($data as $key => $value) {
            $updates .= $key . " = '" . $value . "', ";
        }
        $updates = rtrim($updates, ", ");

        $sql .= "$updates WHERE id= $id ;";
        $query = mysqli_query($GLOBALS["connection"], $sql);
        $GLOBALS['query'] = $query;
        return $query;
    }
}

/**
 * 
 * @param $table string
 * @param $id    int
 * @return bool
 * 
 */
if (!function_exists('db_delete')) {
    function db_delete(string $table, int $id)
    {
        $sql = 'DELETE FROM ' . $table . " WHERE id=$id ";
        $query = mysqli_query($GLOBALS["connection"], $sql);
        $GLOBALS['query'] = $query;
        return $query;
    }
}


/**
 * 
 * @param $table string
 * @param $id    int
 * @return array|false
 * 
 */
if (!function_exists('db_find')) {
    function db_find(string $table, int $id)
    {
        $query = mysqli_query($GLOBALS["connection"], 'SELECT * FROM ' . $table . ' WHERE id = ' . $id);
        $GLOBALS['query'] = $query;
        $result = mysqli_fetch_assoc($query);

        return $result;
    }
}

/**
 * search for the single row Data from database
 * @param string $table 
 * @param string $quire_str
 * @return array|false
 * 
 */
if (!function_exists('db_first')) {
    function db_first(string $table, string $query_str, string $select = '*')
    {
        $sql = "SELECT $select FROM $table $query_str";
        $query = mysqli_query($GLOBALS["connection"], $sql);
        $GLOBALS['query'] = $query;
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
}

/**
 * get all use query_str Data from database
 * @param string $table 
 * @param string $quire_str
 * @return array|false
 * 
 */
if (!function_exists('db_get')) {
    function db_get(string $table, string $query_str)
    {
        // $sql = "SELECT * FROM $table $query_str";
        // $query = mysqli_query($GLOBALS["connection"], $sql);
        // $GLOBALS['query'] = $query;
        // $result = [];
        // while ($row = mysqli_fetch_assoc($query)) {
        //     $result[] = $row; // Fetch all rows into an array
        // }
        // return $result;
        $query = mysqli_query($GLOBALS["connection"], "SELECT * FROM $table $query_str");
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query,
            'num' => $num,
        ];
    }
}

/**
 * get all use query_str Data from database
 * @param string $table 
 * @param string $quire_str
 * @param int $limit
 * @return array|false
 * 
 */
if (!function_exists('db_paginate')) {
    function db_paginate(string $table, string $query_str, int $limit = 15, string $order_by = 'asc', string $select = '*'): array
    {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET["page"] > 0) {
            $current_page = $_GET["page"] - 1;
        } else {
            $current_page = 0;
        }
        $query_count = mysqli_query($GLOBALS['connection'], "SELECT COUNT($table.id) FROM $table $query_str");
        $count = mysqli_fetch_row($query_count);
        $total_records = $count[0];

        $start = $current_page * $limit;
        $total_pages = ceil($total_records / $limit);

        if ($current_page >= $total_pages) {
            $start = $total_pages + 1;
        }

        // var_dump($total_pages, $start);

        $sql = "SELECT $select FROM $table $query_str order by $table.id $order_by limit {$start},{$limit}";


        $query = mysqli_query($GLOBALS["connection"], $sql);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query,
            'num' => $num,
            'render' => render_paginate($total_pages, $current_page),
            'current_page' => $current_page,
            'limit' => $limit,
        ];
    }
}

if (!function_exists('render_paginate')) {
    function render_paginate(int $total_pages, int $current_pages): string
    {
        $disabled_prev = '';
        $disabled_next = '';
        $prev = ($current_pages < 1) ? 1 && $disabled_prev = 'disabled' : $current_pages;
        $next = ($current_pages + 2 > $total_pages) ? $total_pages && $disabled_next = 'disabled' : $current_pages + 2;

        $html = "<ul class='pagination justify-content-center' dir='ltr'>";
        $html .= "<li class='page-item $disabled_prev'><a class='user-select-none page-link' href='?page=" . $prev . "'>Previous</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i - 1 == $current_pages) ? "active" : "";
            $html .= "<li class='page-item  $active ' > <a class='user-select-none page-link' href='?page=" . $i . "'>" . $i . "</a> </li>";
        }
        $html .= "<li class='page-item $disabled_next'><a class='user-select-none page-link' href='?page=" . $next . "'>Next</a></li>";
        $html .= "</ul>";
        return $html;
    }
}



