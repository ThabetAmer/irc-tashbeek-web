import {$httpRequester} from './httpRequester';

export const get = (caseType, caseId, params = {}) => {
  return $httpRequester.get(`api/case-notes/${caseType}/${caseId}/`)
}


export const post = (caseType, caseId, params = {}) => {
  return $httpRequester.post(`api/case-notes/${caseType}/${caseId}`, params)
}

