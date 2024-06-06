<template>
  <div class="catalog">
    <h2>Каталог книг</h2>
    <p>Будь які книги на ваш вибір.</p>

    <div v-if="books.length === 0">Завантаження...</div>

    <div v-else>
      <div v-for="(row, index) in Math.ceil(books.length / 4)" :key="index" class="book-row">
        <div class="book" v-for="book in getBooksInRow(index)" :key="book.id">
          <img :src="book.img_src" alt="Book Cover" class="book-cover">
          <div class="book-info">
            <h3>{{ book.name }}</h3>
            <h4>{{ book.author }}</h4>
            <p>Ціна: {{ book.price }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      books: []
    };
  },
  created() {
    this.fetchBooks();
  },
  methods: {
    fetchBooks() {
      axios.get('http://localhost/BookStore/backend/getBooks.php')
        .then(response => {
          this.books = response.data;
        })
        .catch(error => {
          console.error("There was an error!", error);
        });
    },
    getBooksInRow(rowIndex) {
      const start = rowIndex * 4;
      const end = start + 4;
      return this.books.slice(start, end);
    }
  }
};
</script>

<style scoped>
.catalog {
  max-width: 1000px;
  margin: 0 auto;
  margin-bottom: 200px;
}

.book-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 50px;
}

.book {
  width: calc(100% / 4 - 10px);
  text-align: center;
}

.book-cover {
  width: 90%;
  margin-bottom: 10px;
}

.book-info h3 {
  margin: 0;
}

.book-info h4, .book-info p {
  margin: 5px 0;
}
.book-info {
  margin-bottom: 30px;
}
</style>
