Rails.application.routes.draw do
  devise_for :users
  root to: 'welcome#index'

  resources :events do
    resources :discussions, only: [:create, :new, :delete, :update, :show]
  end
end
