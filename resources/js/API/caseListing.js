import {$httpRequester} from './httpRequester';


export const get = (type, params = {}) => {
  return $httpRequester.get(`index/${type}`, {params})
}