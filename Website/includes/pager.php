                <ul class="pager">
                    <?php
                        //Previous Page Button
                        if ($page <= 1) {
                            echo "<li class='disabled'><a><i class='fa fa-fw fa-chevron-left'></i></a></li>";
                        } else {
                            $page_prev = $page - 1;
                            echo "<li><a href='index.php?page={$page_prev}'><i class='fa fa-fw fa-chevron-left'></i></a></li>";
                        }
                        
                        //Shows Two Pages Before and After Active Page
                        $min_page = $page - 2;
                        $max_page = $page + 2;

                        if ($min_page < 2) {
                            $max_page = 5;
                        }
                    
                        if ($page == $pager_count) {
                            $min_page = $min_page - 2;
                        } else if ($page == ($pager_count - 1)) {
                            $min_page = $min_page - 1;
                        }
                    
                        if ($min_page < 1) {
                            $min_page = 1;
                        }
                    
                        if ($max_page > $pager_count) {
                            $max_page = $pager_count;
                        }

                        for ($i = $min_page; $i <= $max_page; $i++) {
                            if ($i == $page) {
                                echo "<li><a class='active' href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        //Next Page Button
                        if ($page >= $pager_count) {
                            echo "<li class='disabled'><a><i class='fa fa-fw fa-chevron-right'></i></a></li>";
                        } else {
                            $page_next = $page + 1;
                            echo "<li><a href='index.php?page={$page_next}'><i class='fa fa-fw fa-chevron-right'></i></a></li>";
                        }
                    ?>
                </ul>