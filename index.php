<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Название</title>
    <link rel="stylesheet" href="assets/styles/main.css">
    <link id="themeStyle" rel="stylesheet" href="assets/styles/light_theme.css">
    <script src="scripts/script.js"></script>
    <?php 
        session_start();
		require('scripts/connection.php');
	?>
</head>
<body>
    <header>
        <nav class="left-nav">
            <ul>
                <?php
                    if ($_SESSION['auth'] == true) {
                        echo '<li><a class="add_book_button" style="cursor: pointer">Добавить книгу</a></li>';
                        echo '<li><a class="add_categories_button" style="cursor: pointer">Добавить категории</a></li>';
                        echo '<li><a href="pages/issues_magazine_page.php">Журнал выдачи</a></li>';
                        if ($_SESSION['role_id'] == 1){
                            echo '<li><a href="pages/reg_page.php" class="add_book_button">Добавить пользователя</a></li>';
                        }
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

    <section class="banner">
        <h1>Добро пожаловать в библиотеку</h1>
        <p>Найдите свою следующую книгу в нашем обширном каталоге</p>
    </section>

    <section class="featured-books">
        <h2>Список книг</h2>
        <div name="search_panel">
            <input type="text" id="search_input" placeholder="Название">
            <?php
                $query = "SELECT id, genre_name FROM genres";
                $genres_list = mysqli_query($connection, $query);
                $query = "SELECT id, author_name FROM authors";
                $authors_list = mysqli_query($connection, $query);

                // Проверка наличия результата
                if ($genres_list && mysqli_num_rows($genres_list) > 0) {
                    echo '<select id="genre_select" name="genre_select">';
                    echo '<option value="all" selected>Все жанры</option>';
            
                    // Вывод опций для каждого жанра
                    while ($row = mysqli_fetch_assoc($genres_list)) {
                        echo '<option value="' . $row['id'] . '">' . $row['genre_name'] . '</option>';
                    }
            
                    echo '</select>';
                } else {
                    echo 'Жанры не найдены.';
                }

                // Проверка наличия результата
                if ($authors_list && mysqli_num_rows($authors_list) > 0) {
                    echo '<select id="author_select" name="author_select">';
                    echo '<option value="all" selected>Все авторы</option>';
            
                    // Вывод опций для каждого жанра
                    while ($row = mysqli_fetch_assoc($authors_list)) {
                        echo '<option value="' . $row['id'] . '">' . $row['author_name'] . '</option>';
                    }
            
                    echo '</select>';
                } else {
                    echo 'Жанры не найдены.';
                }
            ?>
            
            <button id="filter_button" onclick="booksFilter()">Найти</button>
        </div>

        <!-- Вывод списка книг -->
        <div class="book-list" id="book_list">
            <?php require("scripts/load_books_list.php"); ?>
        </div>       
    </section>
    
    <!-- Модальное окно добавления книги -->
    <?php require("modals/add_book_modal.php") ?>

    <!-- Модальное окно добавления категорий -->
    <?php require("modals/add_categories_modal.php") ?>

    <!-- Модальное окно редактирования -->
    <div id="edit_modal" class="modal"></div>

    <!-- Модальное окно с информацией о книге -->
    <div id="book_information_modal" class="modal"></div>

    <!-- Модальное окно с выдачи -->
    <div id="issue_modal" class="modal"></div>

    

    <footer>
        <img src="assets/img/logo.png" alt="logo"></img>
        <p>Библиотека ГАПОУ СО "ЕМК"</p>
        <div class="footer-contact">
            <h4>Контактная информация</h4>
            <p>г.Екатеринбург, ул.Декабристов, 83</p>
            <p><i class="fa fa-phone-square"></i>Телефон: +7 (902)8753672</p>

            <p><i class="fa fa-envelope"></i>
            Эл. почта: <a class="mail-link" href="mailto:kruzha2006@rambler.ru">kruzha2006@rambler.ru</a>
            </p>
            <p><i class="fa fa-envelope"></i>
            Сайт колледжа: <a href="http://xn--d1abafrgaft.xn--p1ai/">емколледж.рф</a>
            </p>
        </div>
    </footer>
</body>

<script>
    modalsHendlers();

    // Переход наверх страницы по нажатию на логотип
    document.querySelector('logo').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
</html>