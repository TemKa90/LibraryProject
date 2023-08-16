<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал выдачи</title>
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/light_theme.css">
    <script src="../scripts/script.js"></script>
    <?php 
        session_start();
        require('../scripts/connection.php');
	?>
</head>

<body>
    <header>
        <nav class="left-nav">
            <ul>
                <li><a href="../index.php">Главная</a></li>
                <?php
                    if ($_SESSION['auth'] == true) {
                        echo '<li><a href="reg_page.php" class="add_book_button">Добавить пользователя</a></li>';
                        echo '<li><a href="issues_magazine_page.php">Журнал выдачи</a></li>';
                    }
                ?>
            </ul>
        </nav>
        <logo></logo>
        <nav class="right-nav">
            <ul>
                <?php
                    if ($_SESSION['auth'] != true) {
                        echo '<li><a href="pages/login_page.php">Войти</a></li>';
                    } else {
                        echo '<li><a href="scripts/logout.php">Выйти</a></li>';
                    }
                ?>
                <li>              
                    <label class="switch theme-switch">
                        <input type="checkbox" id="theme-toggle" onchange="changeTheme()" value="dark">
                        <span class="slider round"></span>
                    </label>
                </li>
            </ul>
        </nav>
        
    </header>

    <section class="issue-magazine-section">
        <h2>Журнал выдачи</h2>
        <div name="search_panel">
            <input type="text" id="book_search_input" placeholder="Название книги">
            <input type="text" id="student_search_input" placeholder="ФИО студента">
            <input type="text" id="group_search_input" placeholder="Группа">
    
            <label class="switch">
                <input type="checkbox" id="status_checkbox" value="2">
                <span class="slider round" ></span>
                <span class="label-on">Возвращена</span>
                <span class="label-off">Выдана</span>
            </label>
            
            <button id="filter_button" onclick="issuesFilter()">Найти</button>
        </div>

        <div class="scroll-table">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Книга</th>
                        <th scope="col">Студент</th>
                        <th scope="col">Группа</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Идентификатор книги</th>
                    </tr>
                </thead>
            </table>
            <div class="scroll-table-body">
                <table>
                    <tbody id="issues_tbody">
                        <?php 
                            require("../scripts/load_issues_magazine.php");
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </section>
    <!-- Модальное окно с информацией о книге -->
    <div id="book_information_modal" class="modal"></div>
</body>
<script>
    modalsHendlers();
</script>
</html>