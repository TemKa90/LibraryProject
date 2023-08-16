<div id="add_categories_modal" class="modal">
    <div class="modal-content add-categories-modal-content">
        <span class="close">&times;</span>
        <h2>Добавить категории</h2>
        <form  method="post" action="scripts/edit_or_add.php" id="editForm" class="form-container">

            <div id="author_container" class="author_container">
                <div id="author_toggle_button">Добавить автора</div>
                <div class="content">
                    <input type="text" id="author_name" name="author_name" value="" placeholder="Полное имя автора">
                </div>
            </div>

            <div id="genre_container" class="genre_container">
                <div id="genre_toggle_button">Добавить жанр</div>
                <div class="content">
                    <input type="text" id="genre_name" name="genre_name" value="" placeholder="Название жанра">
                </div>
            </div>

            <div id="publisher_container" class="publisher_container">
                <div id="publisher_toggle_button">Добавить издательство</div>
                <div class="content">
                    <input type="text" id="publisher_name" name="publisher_name" value="" placeholder="Название издательства">
                </div>
            </div>

            <input type="hidden" name="book_id_storage" value="">
            <button type="submit" id="book_data_save_button" class="save-btn">Сохранить</button>
        </form>
    </div>
</div>