import {$httpRequester} from './httpRequester';


export const get = (type, params = {}) => {
  $httpRequester.get(`index/${type}`, {params})
}