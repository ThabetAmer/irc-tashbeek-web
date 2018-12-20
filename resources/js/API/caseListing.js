import {$httpRequester} from './httpRequester';
import queryString from '../helpers/query-string'

export const get = (type, params = {}) => {
  return $httpRequester.get(`api/cases/${type}?${queryString.serialize(params)}`)
}