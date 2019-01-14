import {$httpRequester} from './httpRequester';

export const get = (params = {}) => {
  return $httpRequester.get(`api/cards`)
}
