// function updateAction() {
//     let genreId = document.getElementById("genre_select").value;
//     let form = document.getElementById("genre-form");
//     form.action = "pages/genre_page.php?genre_id=" + genreId;
// }

function validateGenreForm() {
    // Проверяем, что условие выполняется
    let selectedOption = document.getElementById("genre_select").value;
    if (selectedOption === "disable") {
        // Отменяем отправку формы
        alert("Необходимо выбрать жанр");
        return false;
    }
}

function confirmDelete() {
    event.stopPropagation();
    return confirm("Вы уверены, что хотите удалить эту книгу?");
}

function confirmEdit() {
    return confirm("Вы уверены, что хотите отредактировать эту книгу?");
}

function closeModal(){
    let closeButtons = document.getElementsByClassName('close');

    // Обработчик для закрытия модального окна
    Array.from(closeButtons).forEach(button => button.addEventListener('click', function() {

        if (window.location.href.includes('issues_magazine_page')) {
            book_information_modal.style.display = 'none';
        } else {
            add_book_modal.style.display = 'none';
            add_categories_modal.style.display = 'none';
            edit_modal.style.display = 'none';
            issue_modal.style.display = 'none';
            book_information_modal.style.display = 'none';
        }
    }))
}

function modalsHendlers() {
    let add_book_modal = document.getElementById('add_book_modal');
    let add_categories_modal = document.getElementById('add_categories_modal');
    let edit_modal = document.getElementById('edit_modal');
    let book_information_modal = document.getElementById('book_information_modal');
    let issue_modal = document.getElementById('issue_modal');

    let addBookButton = document.getElementsByClassName('add_book_button');
    let addCategotiesButton = document.getElementsByClassName('add_categories_button');
    let editButtons = document.getElementsByClassName('edit_book_button');
    let issue_button = document.getElementsByClassName('issue_book_button');
    let bookCards = Array.from(document.getElementsByClassName('book_card')).concat(Array.from(document.getElementsByClassName('book_table_cell')));
    


    // Обработчик для открытия модального окна по кнопке добавления книги
    if(addBookButton.length > 0){
        addBookButton[0].addEventListener('click', function() {
            add_book_modal.style.display = 'block';
            closeModal();
        });
    };

    // Обработчик для открытия модального окна по кнопке добавления категорий
    if(addCategotiesButton.length > 0){
        addCategotiesButton[0].addEventListener('click', function() {
            add_categories_modal.style.display = 'block';

            let authorToggleButton = document.getElementById('author_toggle_button');
            let genreToggleButton = document.getElementById('genre_toggle_button');
            let publisherToggleButton = document.getElementById('publisher_toggle_button');
        
            let authorNameInput = document.getElementById('author_name');
            let genreNameInput = document.getElementById('genre_name');
            let publisherNameInput = document.getElementById('publisher_name');
        
            let authorContainer = document.querySelector('.author_container');
            let genreContainer = document.querySelector('.genre_container');
            let publisherContainer = document.querySelector('.publisher_container');
        
            let bookDataSaveButton = document.getElementById('book_data_save_button');
        
            authorToggleButton.addEventListener('click', function() {
                authorContainer.classList.toggle('open');
                bookDataSaveButton.name = 'add_author_confirm';
                authorNameInput.required  = true;
        
                genreContainer.classList.remove('open');
                genreNameInput.required  = false;
                publisherContainer.classList.remove('open');
                publisherNameInput.required  = false;
            })
            genreToggleButton.addEventListener('click', function() {
                genreContainer.classList.toggle('open');
                bookDataSaveButton.name = 'add_genre_confirm';
                genreNameInput.required  = true;
        
                authorContainer.classList.remove('open');
                authorNameInput.required  = false;
                publisherContainer.classList.remove('open');
                publisherNameInput.required  = false;
            })
            publisherToggleButton.addEventListener('click', function() {
                publisherContainer.classList.toggle('open');
                bookDataSaveButton.name = 'add_publisher_confirm';
                publisherNameInput.required  = true;
        
                authorContainer.classList.remove('open');
                authorNameInput.required  = false;
                genreContainer.classList.remove('open');
                genreNameInput.required  = false;
            })

            closeModal();
        });
    };

    // Обработчик для открытия модального окна по кнопке редактирования
    if(editButtons.length > 0){
        for (let i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener('click', function() {
                event.stopPropagation();
                let bookId = this.id;
    
                // Выполняем AJAX-запрос на сервер
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'modals/edit_modal.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + bookId);
    
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let book_data = xhr.responseText;
        
                        // Открываем модальное окно
                        edit_modal.innerHTML = book_data;
                        edit_modal.style.display = 'block';
                        closeModal();
                    }
                };
            });
        };
    };

    // Обработчик для открытия модального окна по кнопке выдачи
    if(issue_button.length > 0){
        for (let i = 0; i < issue_button.length; i++) {
            issue_button[i].addEventListener('click', function() {
                event.stopPropagation();
                let bookId = this.id;
    
                // Выполняем AJAX-запрос на сервер
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'modals/issue_modal.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + bookId);
    
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let book_data = xhr.responseText;
        
                        // Открываем модальное окно
                        issue_modal.innerHTML = book_data;
                        issue_modal.style.display = 'block';
                        closeModal();
                    }
                };
            });
        };
    };

    // Обработчик для открытия модального окна по нажатию на карточку книги или на название книги в таблице
    if(bookCards.length > 0){
        for (let i = 0; i < bookCards.length; i++) {
            bookCards[i].addEventListener('click', function() {
                let bookId = this.id;
    
                // Выполняем AJAX-запрос на сервер
                let xhr = new XMLHttpRequest();
                if (window.location.href.includes('issues_magazine_page')) {
                    xhr.open('POST', '../modals/info_modal.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('id=' + bookId + '&path=../assets/img/books/');
                } else {
                    xhr.open('POST', 'modals/info_modal.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('id=' + bookId + '&path=assets/img/books/');
                }
                
                
    
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let book_data = xhr.responseText;
        
                        // Открываем модальное окно
                        book_information_modal.innerHTML = book_data;
                        book_information_modal.style.display = 'block';
                        closeModal();
                    }
                };
                
            });
        };
    };

    // Закрывать модальное окно при клике вне его области
    window.addEventListener('click', function(event) {
        if (event.target == add_book_modal || event.target == add_categories_modal || event.target == edit_modal || event.target == issue_modal || event.target == book_information_modal) {
            if (window.location.href.includes('issues_magazine_page')) {
                book_information_modal.style.display = 'none';
            } else {
                add_book_modal.style.display = 'none';
                add_categories_modal.style.display = 'none';
                edit_modal.style.display = 'none';
                issue_modal.style.display = 'none';
                book_information_modal.style.display = 'none';
            }
        }
    })
}

// Выдача книги
function bookIssue(){
    let selectedStudent = document.getElementById('students_select').value;
    let selectedBook = document.getElementById('selected_book').value;
    let uniqueNumber = document.getElementById('unique_number').value;

    if (selectedStudent == "disable") {
        alert("Необходимо выбрать студента");
    } else {
        // Выполняем AJAX-запрос на сервер
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/book_issue.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('selected_student=' + selectedStudent + '&selected_book=' + selectedBook + '&unique_number=' + uniqueNumber);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                let response = xhr.responseText;

                if (response == "success") {
                    alert("Книга выдана");
                } else if (response == "failure") {
                    alert("Произошла ошибка. Книга не выдана");
                } else if (response == "quantity") {
                    alert("Этой книги больше нет в наличии");
                }
            }
        }
    }
}

// Обработчик для кнопки фильтрации списка книг
function booksFilter(){
    let searchedTitle = document.getElementById('search_input').value;
    let genreId = document.getElementById('genre_select').value;
    let authorId = document.getElementById('author_select').value;

    // Выполняем AJAX-запрос на сервер
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'scripts/load_filtered_books_list.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('genre_id=' + genreId + '&author_id=' + authorId + '&search=' + searchedTitle);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let books = xhr.responseText;

            // // Отображение полученных данных на странице
            let bookList = document.getElementById('book_list');
            bookList.innerHTML = books;

            modalsHendlers();
        }
    }
}

// Обработчик для кнопки фильтрации журнала выдачи
function issuesFilter(){
    let bookSearch = document.getElementById('book_search_input').value;
    let studentSearch = document.getElementById('student_search_input').value;
    let groupSearch = document.getElementById('group_search_input').value;
    let status_checkbox = document.getElementById('status_checkbox');
    let status;
    if (status_checkbox.checked) {
        status = 2;
    } else{
        status = 1;
    }

    // Выполняем AJAX-запрос на сервер
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../scripts/load_filtered_issues_magazine.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('book_search=' + bookSearch + '&student_search=' + studentSearch + '&group_search=' + groupSearch + '&status=' + status);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let issues_list = xhr.responseText;

            // // Отображение полученных данных на странице
            let issues_tbody = document.getElementById('issues_tbody');
            issues_tbody.innerHTML = issues_list;

            modalsHendlers();
        }
    }
}

// Обработчик кнопки обновления статуса записи в журнале выдачи
function updateReturnStatus(button) {
    let issueId = button.id;
    // Выполняем AJAX-запрос на сервер
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../scripts/issue_status_update.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + issueId);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = xhr.responseText;
            if (response == "success") {
                alert("Статус успешно изменён");
            } else if (response == "failure") {
                alert("Произошла ошибка. Статус не изменён");
            } else {
                console.log(response);
            }
        }
    }
}

// Вывод списка студентов выбранной группы в select
function studentsLoad(){
    let selectedGroup = document.getElementById('group_select').value;

    // Выполняем AJAX-запрос на сервер
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'scripts/load_students_list.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('group_id=' + selectedGroup);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let students = xhr.responseText;

            // // Отображение полученных данных на странице
            let studentsSelect = document.getElementById('students_select');
            studentsSelect.innerHTML = students;
        }
    }
}

// Смена темы
function changeTheme() {
    let toggleSwitch = document.getElementById('theme-toggle');
    let path;

    if (window.location.href.includes('issues_magazine_page')) {
        path = '../assets/styles/';
    } else {
        path = 'assets/styles/';
    }

    let darkThemeStylesFile = document.createElement('link');
    darkThemeStylesFile.rel = 'stylesheet';
    darkThemeStylesFile.type = 'text/css';
    darkThemeStylesFile.href = path + 'dark_theme.css';

    let lightThemeStylesFile = document.createElement('link');
    lightThemeStylesFile.rel = 'stylesheet';
    lightThemeStylesFile.type = 'text/css';
    lightThemeStylesFile.href = path + 'light_theme.css';

    let addedDarkThemeStyles = false;
    let addedLightThemeStyles = false;

    if (toggleSwitch.checked) {
        if (!addedDarkThemeStyles) {
            document.head.appendChild(darkThemeStylesFile);
            addedDarkThemeStyles = true;
        }
        if (addedLightThemeStyles) {
            document.head.removeChild(lightThemeStylesFile);
            addedLightThemeStyles = false;
        }
    } else {
        if (!addedLightThemeStyles) {
            document.head.appendChild(lightThemeStylesFile);
            addedLightThemeStyles = true;
        }
        if (addedDarkThemeStyles) {
            document.head.removeChild(darkThemeStylesFile);
            addedDarkThemeStyles = false;
        }
    }
}