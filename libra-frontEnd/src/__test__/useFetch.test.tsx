import { act, renderHook } from '@testing-library/react-hooks'
import { UseFetch } from 'hooks/useFetch'

describe('useFetch', () => {
  it('should return data with a successful api request', async () => {
    global.fetch = jest.fn()

    await act(async () => {
      renderHook(() => UseFetch('https://127.0.0.1:8000/api/books'))
    })

    expect(global.fetch).toBeCalledWith('https://127.0.0.1:8000/api/books')
  })
})
