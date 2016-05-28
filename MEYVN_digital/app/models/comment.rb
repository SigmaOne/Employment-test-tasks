class Comment < ApplicationRecord
  belongs_to :discussion
  belongs_to :user

  validates :user, presence: true
  validates :content, length: { in: 1..500 }
  validates :created_at, presence: true
end
