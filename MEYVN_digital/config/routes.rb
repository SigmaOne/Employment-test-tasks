Rails.application.routes.draw do
  get 'discussions/show'

  resources :events do
    resources :discussions, only: [:create, :new, :delete, :update, :show]
  end
end
