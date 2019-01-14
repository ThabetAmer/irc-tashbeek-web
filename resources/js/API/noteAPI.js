import {$httpRequester} from './httpRequester';

export const get = (caseType, caseId, params = {}) => {
  return $httpRequester.get(`api/case-notes/${caseType}/${caseId}/`)
}


export const post = (caseType, caseId, params = {}) => {
  return $httpRequester.post(`api/case-notes/${caseType}/${caseId}`, params)
}



export const setNoteStarred = (caseType, caseId,noteId, params = {}) => {
  return $httpRequester.post(`api/case-notes/${caseType}/${caseId}/${noteId}/star`, params)
}

export const getStarredNote = (caseType, caseId,noteId, params = {}) => {
  return $httpRequester.post(`api/case-notes/${caseType}/${caseId}/${noteId}/star`, params)
}







