import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) {}

  getGroupesMusicaux(): Observable<any> {
    return this.http.get(`${this.apiUrl}/groupes-musicaux`);
  }

  supprimerGroupeMusical(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/groupes-musicaux/${id}`);
  }

  actualiserGroupeMusical(id: number, data: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/groupes-musicaux/${id}`, data);
  }
}
