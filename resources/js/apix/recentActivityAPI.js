import {$httpRequester} from './httpRequester';
import queryString from '../helpers/QueryString'

export const get = (params = {}) => {
  return $httpRequester.get(`api/recent-activities`)
}
