import '@testing-library/jest-dom'
import {render , screen  , cleanup} from '@testing-library/react';
import BookCard from 'components/bookCard';

afterEach(()=>{
    cleanup();
});

test('should render component bookCard',()=>{
    const book = {
        id : 1,
        title: 'title',
        author: "william jose",
        genre: 'fiction',
      }

      render(<BookCard {...book} />);
      const bookElement = screen.getByTestId('book-1');
      expect(bookElement).toBeInTheDocument();
})
