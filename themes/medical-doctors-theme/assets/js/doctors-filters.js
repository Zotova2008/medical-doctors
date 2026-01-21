document.addEventListener('DOMContentLoaded', function() {
  // Находим все ссылки пагинации
  const paginationLinks = document.querySelectorAll('.pagination-wrapper a');

  paginationLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      // Получаем текущий href
      let href = this.getAttribute('href');

      // Собираем значения фильтров
      const specialization = document.querySelector('#specialization')?.value || '';
      const city = document.querySelector('#city')?.value || '';
      const sort = document.querySelector('#sort')?.value || '';

      // Формируем массив параметров
      const params = [];
      if (specialization) params.push('specialization=' + encodeURIComponent(specialization));
      if (city) params.push('city=' + encodeURIComponent(city));
      if (sort) params.push('sort=' + encodeURIComponent(sort));

      // Если есть параметры, добавляем к ссылке
      if (params.length > 0) {
        const separator = href.indexOf('?') !== -1 ? '&' : '?';
        this.setAttribute('href', href + separator + params.join('&'));
      }
    });
  });
});