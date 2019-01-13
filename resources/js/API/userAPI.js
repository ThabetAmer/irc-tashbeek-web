import {$httpRequester} from './httpRequester';
import queryString from '../helpers/QueryString'

export const get = (params = {}) => {
  return $httpRequester.get(`api/users?${queryString.serialize(params)}`)
}


export const activateUser = (id,params = {}) => {
  return $httpRequester.post(`api/users/${id}/activate`)
}

export const deactivateUser = (id,params = {}) => {
  return $httpRequester.post(`api/users/${id}/deactivate`)
}

export const update = (id,params = {}) => {
  return $httpRequester.put(`api/users/${id}`, params)
}
export const create = (params = {}) => {
  return $httpRequester.post(`api/users`, params)
}