<template>
  <div class="catalog">
    <h2>Детективи</h2>

    <div v-if="books.length === 0">Завантаження...</div>

    <div v-else>
      <div v-for="(row, index) in Math.ceil(books.length / 3)" :key="index">
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
      axios.get('http://localhost/BookStore/backend/getDetective.php')
        .then(response => {
          this.books = response.data;
        })
        .catch(error => {
          console.error("There was an error!", error);
        });
    },
    getBooksInRow(rowIndex) {
      const start = rowIndex * 3;
      const end = start + 3;
      return this.books.slice(start, end);
    }
  }
}
</script>

<style >
.catalog {
  max-width: 800px;
  margin: 0 auto;
  margin-bottom: 200px;
}

.book {
  display: inline-block;
  width: calc(100% / 3);
  text-align: center;
}

.book-cover {
  width: 80%;
  margin-bottom: 10px;
}

.book-info h3 {
  margin: 0;
}

.book-info h4, .book-info p {
  margin: 5px 0;
}
.book-info{
  margin-bottom: 50px;
}
</style>
