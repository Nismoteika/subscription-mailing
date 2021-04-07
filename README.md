## описание путей API
- (AUTH)   - нужна аутентификация
- METHOD   - http метод
- uri      - относительный путь
- описание - описание точки API
- (params) - параметры запроса, у GET это ?param1=val1&param2=val2, POST header->body->form-data
- \* - обязательный параметр

## API (work paths)

- POST /api/v1/auth/login - вход пользователя (*email, *password)
- (AUTH) POST /api/v1/subscribe - подписаться на рубрику (*rubric_id или json массив)
- (AUTH) POST /api/v1/unsubscribe - отписаться от рубрики (*rubric_id или json массив)
- (AUTH) POST /api/v1/unsubscribeAll - отписаться от всех рубрик
- (AUTH) GET /api/v1/usersBySubs - получить список пользователей подписанных на рубрику (*limit, *offset, *rubric_id)
- (AUTH) GET /api/v1/subsByUser - получить список рубрик на которые подписан пользователь (*limit, *offset)
- GET /api/v1/rubrics - получить список рубрик