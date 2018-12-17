import {$httpRequester} from './httpRequester';


export const get = (type) => {
  return new Promise((resolve, reject) => {
    $httpRequester
      .get(`index/${type}`)
      .then(resp => {
        resolve(resp.data);
      })
      .catch(error => {
        console.error('Error in getting forms', error);
        reject(error);
      });
  });
}